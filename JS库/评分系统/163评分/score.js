	var videoInfo = { score : 5, amount : 1 };//默认值
	//评分
	var Score = {
		
		averInt : null,
		averPoint : null,
		amount : null,
		curScore : null,
		jsUrl : null,
		vid : null,
		
		initView : function(info) {
			if(info.amount==0 || info.amount==null){info = { score : 5, amount : 1 }}
			var aver = info.score / info.amount; averStr = String(aver).split(".");
			this.averInt.innerHTML = averStr[0];
			if (averStr[1] && averStr[1] != "") {
				this.averPoint.innerHTML = "." + averStr[1].substr(0, 1);
			} else {
				this.averPoint.innerHTML = ".0";
			}
			this.amount.innerHTML = info.amount;
			aver = Math.round(aver / 10 * 100);
			this.curScore.style.width = aver + "%";
			this.curScore.innerHTML = aver;
		},
		
		get : function() {
			NTES.Ajax.importJs(
				Score.jsUrl,
				function() {
					if (videoInfo) {
						Score.initView(videoInfo);
					}
				},
				"gb2312"
			);
		},
		
		post : function(score) {
			var oFrame = document.createElement("iframe");
			oFrame.id = "uploadResponse";
			oFrame.src = "http://so.v.163.com/acceptvideoscore.do?vid="+Score.vid+"&score="+score;
			oFrame.style.display = "none";
			document.body.appendChild(oFrame);
			$('#uploadResponse').addEvent(
				"load",
				function(event) {
					videoInfo.score += score; videoInfo.amount++;
					Score.initView(videoInfo);
					document.body.removeChild($('#uploadResponse'));
					alert("您的评分已提交");
				}
			);
			/*NTES.Ajax.send(
				"http://so.v.163.com/acceptvideoscore.do",
				"POST",
				{ score : score, vid : '${v.vid}' },
				{
					onSuccess : function() {
						videoInfo.score += score; videoInfo.amount++;
						Score.initView(videoInfo);
						alert("您的评分已提交");
					}
				}
			);*/
		},
		
		init : function(obj) {
			var panel = $(obj);
			this.averInt = panel.$("span.num")[0]; this.averPoint = panel.$("span.num2")[0];
			this.amount = panel.$("span.amount")[0];
			var li = panel.$("li");
			this.curScore = li[0];
			this.get();
			for (var i = 1; i <= 10; i++) {
				$(li[i]).addEvent(
					"click",
					function(event) {
						Score.post(this);
						NTES.Event.fix(event).preventDefault();
					}.bind(new Number(i))
				);	
			}
		}
	};