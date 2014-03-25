function Scroller (varName, containerId, contentTemplate, contentData, scrollStepTimeout, scrollStepAcceleration, scrollInitialDistanceDivisor) 
{
	this.VariableName = varName;
	this.ContainerHandle = document.getElementById(containerId);
	this.ContentTemplate = contentTemplate;
	this.ContentData = contentData;
	this.ContentHandles = new Array();
	this.ContentWidths = new Array();
	this.FirstIndexDisplayed = -1;
	this.IsInitialized = false;
	this.AnimationTimeoutHandle = null;
	this.ScrollStepTimeout = scrollStepTimeout;
	this.ScrollStepAcceleration = scrollStepAcceleration;
	this.ScrollInitialDistanceDivisor = scrollInitialDistanceDivisor;

	this.MovePrevious = function ()
	{
		if (this.IsInitialized && this.FirstIndexDisplayed > 0)
		{
			this.FirstIndexDisplayed--;
			this.UpdateContent();
		}
	}
	
	this.MoveNext = function ()
	{
		if (this.IsInitialized && this.FirstIndexDisplayed < this.ContentData.length - 1)
		{
			this.FirstIndexDisplayed++;
			this.UpdateContent();
		}
	}
	
	this.MoveNextPage = function()
	{
		if (this.IsInitialized && this.FirstIndexDisplayed < this.ContentData.length - 1)
		{	
			var maxWidth = this.ContainerHandle.offsetWidth;
			var i;
			var lastIndexDisplayed = this.FirstIndexDisplayed;
			for (i = this.FirstIndexDisplayed; i < this.ContentHandles.length; i++)
			{
				if (parseInt(this.ContentHandles[i].style.left) < maxWidth && parseInt(this.ContentHandles[i].style.left) + this.ContentWidths[i] < maxWidth)
				{
					lastIndexDisplayed = i;
				}
				else
					break;
			}
			
			if (lastIndexDisplayed + 1 > this.ContentHandles.length - 1)
				return;
			
			this.FirstIndexDisplayed = lastIndexDisplayed + 1;
			this.UpdateContent();
		}
	}
	
	this.MovePreviousPage = function()
	{
		if (this.IsInitialized && this.FirstIndexDisplayed > 0)
		{
			var maxWidth = this.ContainerHandle.offsetWidth;
			var i;
			var firstIndexToDisplay = this.FirstIndexDisplayed - 1;
			for (i = this.FirstIndexDisplayed - 1; i >= 0; i--)
			{
				if (this.ContentWidths[i] < maxWidth)
				{
					maxWidth -= this.ContentWidths[i];
					firstIndexToDisplay = i;
				}
				else
					break;
			}
			
			this.FirstIndexDisplayed = firstIndexToDisplay;
			this.UpdateContent();
		}
	}
	
	this.MoveTo = function (index)
	{
		if (this.IsInitialized && index >= 0 && index <= (this.ContentHandles.length - 1))
		{
			this.FirstIndexDisplayed = index;
			this.UpdateContent();
		}
	}
	
	this.MoveFirst = function ()
	{
		if (this.IsInitialized)
		{
			this.FirstIndexDisplayed = 0;
			this.UpdateContent();
		}
	}
	
	this.MoveLast = function ()
	{
		if (this.IsInitialized)
		{
			this.FirstIndexDisplayed = this.ContentData.length - 1;
			this.UpdateContent();
		}
	}
	
	this.UpdateContent = function()
	{
		if (this.IsInitialized && this.FirstIndexDisplayed >= 0 && this.FirstIndexDisplayed <= (this.ContentHandles.length - 1))
		{
			var currentX = parseInt(this.ContentHandles[this.FirstIndexDisplayed].style.left);
			if (currentX == 0)
				return;
			
			var direction = 1;
			if (currentX > 0)
				direction = -1;
			
			if (this.AnimationTimeoutHandle)
				window.clearTimeout(this.AnimationTimeoutHandle);
			
			step = Math.abs(currentX) / this.ScrollInitialDistanceDivisor;
				
			this.AnimationTimeoutHandle = window.setTimeout('window.' + this.VariableName + '.MoveAnimation(' + direction + ', ' + step + ');', this.ScrollStepTimeout);
		}
	}
	
	this.MoveAnimation = function(direction, step)
	{
		if (this.IsInitialized)
		{
			var currentX = parseInt(this.ContentHandles[this.FirstIndexDisplayed].style.left);
			var done = false;
			var movement = Math.round(direction * step);
			if (Math.abs(currentX + (step * direction)) < step)
			{
				movement = 0 - currentX;
				done = true;
			}
		
			var i;
			for (i = 0; i < this.ContentHandles.length; i++)
			{
				this.ContentHandles[i].style.left = (parseInt(this.ContentHandles[i].style.left) + movement) + 'px';
			}
			
			if (!done)
			{
				step *= this.ScrollStepAcceleration;
				if (step < 1)
					step = 1;
					
				this.AnimationTimeoutHandle = window.setTimeout('window.' + this.VariableName + '.MoveAnimation(' + direction + ',' + step + ');', this.ScrollStepTimeout);
			}
		}
	}

	this.Initialize = function()
	{
		this.IsInitialized = false;	
		
		while (this.ContainerHandle.childNodes.length > 0)
			this.ContainerHandle.removeChild(this.ContainerHandle.childNodes[0]);
		
		if (this.ContentData.length == 0)
		{
			this.ContainerHandle.innerHTML = "&nbsp;";
			return;
		}
	
		var i, j, content, re;
		for(i = 0; i < this.ContentData.length; i++)
		{
			this.ContentHandles[i] = document.createElement("div");
			this.ContentHandles[i].style.position = 'absolute';
			this.ContentHandles[i].style.left = '0px';
			this.ContentHandles[i].style.top = '0px';
			
			content = this.ContentTemplate;
			for (j = 0; j < this.ContentData[i].length; j++)
			{
				re = new RegExp('\\{' + j + '\\}', 'g');
				content = content.replace(re, this.ContentData[i][j]);
			}
			
			this.ContentHandles[i].innerHTML = content;
			this.ContainerHandle.appendChild(this.ContentHandles[i]);
			this.ContentHandles[i].style.visibility = 'hidden';
		}
		
		var currentX = 0;
		var currentWidth;
		for (i = 0; i < this.ContentHandles.length; i++)
		{
			this.ContentWidths[i] = this.ContentHandles[i].offsetWidth;
			this.ContentHandles[i].style.top = '0px';
			this.ContentHandles[i].style.left = currentX + 'px'
			this.ContentHandles[i].style.visibility = 'visible';
			
			currentX += this.ContentWidths[i];
		}
		
		this.FirstIndexDisplayed = 0;
		this.IsInitialized = true;
	}
	
	this.Initialize();	
}