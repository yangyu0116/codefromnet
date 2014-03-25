function _gel(a){return document.getElementById?document.getElementById(a):null}

document.writeln("<TABLE style=\"MARGIN-TOP: 5px\" cellSpacing=0 cellPadding=0 align=center ");
document.writeln("border=0>");
document.writeln("  <TBODY>");
document.writeln("  <TR>");
document.writeln("    <TD background=\.\/image\/eye-r.gif>");
document.writeln("      <DIV style=\"WIDTH: 90px; HEIGHT: 90px\"><IMG ");
document.writeln("      id=EYES_pupil099 style=\"LEFT: 26px; POSITION: relative; TOP: 26px\" ");
document.writeln("      height=13 src=\"\.\/image\/pupil.gif\" width=13 alt=注意了，我在监视你的一举一动哦^0^ border=0 name=EYES_pupil099>      <\/DIV><\/TD>");
document.writeln("    <TD background=\.\/image\/eye-y.gif>");
document.writeln("      <DIV style=\"WIDTH: 90px; HEIGHT: 90px\"><IMG ");
document.writeln("      id=EYES_pupil199 style=\"LEFT: 26px; POSITION: relative; TOP: 26px\" ");
document.writeln("      height=13 src=\"\.\/image\/pupil.gif\" width=13 alt=拜托别这样指着我嘛，眼睛怪难受的 border=0>  <\/DIV><\/TD><\/TR><\/TBODY><\/TABLE>");

var EYES99 = {
  MAX_DIST : 27,     // furthest pupil can move from center
  EYE_RADIUS : 45,   // half the width of the eye image
  PUPIL_RADIUS : 6,  // half the width of the pupil image
  pupils : [],
  
  init : function() {
    var app = EYES99;
    // setup our mousemove handler
    if (document.addEventListener) {
      document.addEventListener("mousemove", app.moveEyes, true);
    } else if (document.attachEvent) {
      document.attachEvent("onmousemove", app.moveEyes);
    }
      
    // grab references to the pupils
    app.pupils = [ _gel("EYES_pupil099"), _gel("EYES_pupil199") ];

    // Call uninit when leaving page to cleanup the handlers
    _IG_AddEventHandler("unload", app.uninit);
  },

  uninit : function() {
    var app = EYES99;
    // clean up our handlers
    if (document.addEventListener) {
      document.removeEventListener("mousemove", app.moveEyes, true);
    } else if (document.attachEvent) {
      document.detachEvent("onmousemove", app.moveEyes);
    }
  },

  moveEyes : function(e) {
    if (!e) e = window.event;
    var app = EYES99;
    
    for (var i = 0; i < app.pupils.length; i++) {
      var pupil = app.pupils[i];
    
      // The middle points of the eyes
      var midx = app.getPagePos(pupil.parentNode,true) + app.EYE_RADIUS;
      var midy = app.getPagePos(pupil.parentNode,false) + app.EYE_RADIUS;
  
      // The distX/distY from eye middles to the mouse
      var distX = e.clientX + document.body.scrollLeft - midx;
      var distY = e.clientY + document.body.scrollTop - midy;
    
      // The absolute distance from eye middles to the mouse
      var dist = Math.sqrt(Math.pow(distX, 2) + Math.pow(distY, 2));
    
      if (dist > app.MAX_DIST) {
        // mouse out of eyeball, scale distX/distY to be at eyeball edge
        var scale = app.MAX_DIST / dist;
        distX *= scale; distY *= scale;
      }

      // Place the pupil appropriately
      pupil.style.left = parseInt(distX + app.EYE_RADIUS - app.PUPIL_RADIUS) + "px";
      pupil.style.top = parseInt(distY + app.EYE_RADIUS - app.PUPIL_RADIUS) + "px";
    }
  },
  
  // get page coords for an element
  getPagePos : function(el, left) {  
    var val=0;
    while(el != null) {
      val += el["offset"+(left?"Left":"Top")];
      el = el.offsetParent;
    }
    return val;
  }
  
};

EYES99.init();