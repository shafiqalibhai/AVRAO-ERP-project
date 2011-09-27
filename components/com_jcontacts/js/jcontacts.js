function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) // this is the way the standards work
    elem = document.getElementById( whichLayer );
  else if( document.all ) // this is the way old msie versions work
      elem = document.all[whichLayer];
  else if( document.layers ) // this is the way nn4 works
   elem = document.layers[whichLayer];
  vis = elem.style;
  // if the style.display value is blank we try to figure it out here
  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
  vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}
function MailtoOther(){
   var mBox1 = document.getElementById("mstreet");
   var mBox2 = document.getElementById("mcity");
   var mBox3 = document.getElementById("mstate");
   var mBox4 = document.getElementById("mzip");
   var mBox5 = document.getElementById("mcountry");
   var oBox1 = document.getElementById("ostreet");
   var oBox2 = document.getElementById("ocity");
   var oBox3 = document.getElementById("ostate");
   var oBox4 = document.getElementById("ozip");
   var oBox5 = document.getElementById("ocountry");

oBox1.value = mBox1.value;
oBox2.value = mBox2.value;
oBox3.value = mBox3.value;
oBox4.value = mBox4.value;
oBox5.value = mBox5.value;
}

window.addEvent('domready', function(){ new Accordion($$('.panel h3.jpane-toggler'), $$('.panel div.jpane-slider'), {onActive: function(toggler, i) { toggler.addClass('jpane-toggler-down'); toggler.removeClass('jpane-toggler'); },onBackground: function(toggler, i) { toggler.addClass('jpane-toggler'); toggler.removeClass('jpane-toggler-down'); },duration: 300,opacity: false}); });

function alphaFilter ( selectedtype )
{
  document.adminForm.alpha.value = selectedtype ;
  document.adminForm.submit() ;
}
// Added for Google Maps
Lightbox = new Class({

	getOptions : function(){
		return {
      idOverlay   : 'lbxOv',
      idContainer : 'lbxCont',
      idBox       : 'lbxBox',
      idBoxIn     : 'lbxBoxIn',
      defaultClass: '',
			waitingImg  : '',
			buttons : {
				yes : 'Yes',
				no  : 'No',
				apply  : 'Apply',
				cancel : 'Cancel',
				close : 'Close',
				ok  : 'OK'
			},
      overlayOpacity : 0.9,
      duration: 350,
      transition: Fx.Transitions.quadIn,
      onOpenComplete : Class.empty,
      onCloseComplete : Class.empty,
      onCloseQuery    : Class.empty
		}
	},

	initialize : function(options, fxOptions){
	  this._isOpen = false;
		this.setOptions(this.getOptions(), options);
		if (this.options.initialize) this.options.initialize.call(this);
    // overlay div
		this.overlay = new Element('div',
		{
			id : this.options.idOverlay,
			styles :  {
									position:'absolute',
									top:0,
									left:0,
									width:'100%',
									display:'none',
									'z-index' : 9997
								}
		}).injectInside(document.body);
    // container for the box
		this.container = new Element('div',
		{
			id : this.options.idContainer,
			styles :  {
									position:'absolute',
									top:0,
									left:0,
									width:'100%',
									display:'none',
									'z-index' : 9998
								}
		}).injectInside(document.body);
    // box itself
	  this.box = new Element('div',
		{
			id : this.options.idBox,
			styles :  {
									position:'relative',
									overflow:'hidden'
								}
		}).injectInside(this.container);

		this.waitingImg  = new Element('img',
		{
			src : this.options.waitingImg,
			styles : {margin : 25}
		});
		this.boxIn = new Element('div',
		{
		  id     : this.options.idBoxIn,
			styles : {
								 'z-index':9999,
								 position:'relative'
			         }
		}).injectInside(this.box);
		/*
		var clickFunc = function()
		{
		  //alert('clicked container : ' + this.canClose);
			if(this.canClose) this.close();
		};

		this.container.addEvent('click', clickFunc.bind(this)); // for FF
		this.overlay.addEvent('click', clickFunc.bind(this));   // for IE
		*/
    this.overlayFx = new Fx.Style(this.overlay, 'opacity', {
      duration : this.options.duration,
      transition : this.options.transition,
      wait : false,
      onStart : function()
      {
        if(this.overlayFx.from == 0)
        {
          // starting fading the overlay IN
          if(window.ActiveXObject)
          {
            // if IE, hide all <select> elements first
            $$('select').each(function(select)
            {
              select.style.visibility = 'hidden';
            });
          }
          this.overlay.setStyle('display','block');
        }
      }.bind(this),
      onComplete:function()
      {
        if(this.overlayFx.to == 0)
        {
          // finished fading the overlay OUT
          if(window.ActiveXObject)
          {
            // if IE, show all <select> elements back
            $$('select').each(function(select)
            {
              select.style.visibility = '';
            });
          }
          this.overlay.setStyle('display','none');
          this._isOpen = false;
					this.fireEvent('onCloseComplete', this);
					//this.options.onCloseComplete.pass([],this).delay(10);
        }
      }.bind(this)
    }).set(0);  // default opacity to 0

    this.containerFx = new Fx.Style(this.container, 'opacity', {
      duration : this.options.duration,
      transition : this.options.transition,
      wait : false,
			onStart : function()
      {
        if(this.containerFx.from == 0)
        {
          // starting fading the container IN
          this.container.setStyle('display','block');
        }
      }.bind(this),
      onComplete:function()
      {
        if(this.containerFx.to == 0)
        {
          // finished fading the container OUT
          this.container.setStyle('display','none');
        }
        else
        {
          // finished fading the container IN
          this._isOpen = true;
					this.fireEvent('onOpenComplete', this);
					//this.options.onOpenComplete.pass([],this).delay(10);
        }
      }.bind(this)
    }).set(0); // default opacity to 0
    
    new Transcorner(this.box, false, {radius : 10});
	  this.box.firstChild.setStyle('background','none');
	  this.box.lastChild.setStyle('background','none');
	},

  set : function(content, class_name, canClose, append)
  {
	  switch($type(content))
	  {
	    case 'element' : if(!append) this.boxIn.setHTML('');
			                 this.boxIn.adopt(content);
	                     break;
	    case 'string'  :
	    case 'number'  : if(append)
                         this.boxIn.setHTML(this.boxIn.innerHTML + content);
											 else
											   this.boxIn.setHTML(content);
											 break;
	  }
		this.boxIn.className = class_name || this.options.defaultClass;
		var col = this.boxIn.getStyle('background-color');
		$$('#' + this.options.idBox + ' b.corner').each(function(b){b.setStyle('background-color',col)});
		this.canClose = canClose || true;
  },

  addButtons : function(buttons)
	{
	  var div = new Element('div',
		{
			styles :
			{
				'margin-top' : 15,
				'text-align' : 'center'
			}
		});
		buttons.each(function(btn)
		{
			div.adopt(new Element('input',
			{
				type  : 'button',
				value : btn.caption,
				styles :
				{
					padding : 3,
					margin : '0 8px'
				},
				events :
				{
					click : function()
					{
						if(btn.onclick) btn.onclick();
						this.close();
					}.bind(this)
				}
			}))
		}, this);
    this.boxIn.adopt(div);
	},

	open : function(content, class_name, canClose)
	{
		if(content) this.set(content, class_name, canClose);
	  // to cover up empty space if page smaller than browser window height
		var w = Window.getSize();
		this.overlay.setStyles({
			height : w.scrollSize.y,
			width  : w.scrollSize.x
		});
    this.container.setStyles({
			height : w.scrollSize.y,
			width  : w.scrollSize.x
		});
    this.overlayFx.start(this.options.overlayOpacity);
    this.containerFx.start(1);
    // center in visible page area
		this.box.setStyles({
		  top : Math.round((w.size.y / 2) + w.scroll.y - (this.box.scrollHeight / 2))//,
		  //left : Math.round((w.size.x / 2) /*+ w.scroll.x */ - (this.box.scrollWidth / 2))
    });
	},
	
	messagebox : function(content, class_name, buttons)
	{
    this.set(content, class_name, false);
		var barray = [];
		$each(buttons, function(clickfunc, btnname)
		{
      barray.push({caption:this.options.buttons[btnname], onclick:clickfunc || Class.empty});
		}, this);
		this.addButtons(barray);
		this.open();
	},
	
	alert : function(content, class_name)
	{
		this.messagebox(content, class_name, {ok : function(){this.close()}.bind(this)});
	},
	
	waitingbox : function(class_name)
	{
		this.open(this.waitingImg, class_name, false);
	},

	close : function()
	{
	  // Abort close if option function returns false or if not open
		if(!this._isOpen || (this.options.onCloseQuery != Class.empty && !this.options.onCloseQuery()))
	    return;
	  this.containerFx.start(0);
	  this.overlayFx.start(0);
	},
	
	gmapShow : function(options, buttons)
	{
		if(this._gmapDisp(options, buttons))
	    if(this.gmOptions.marker)
	    {
				var center = new GLatLng(parseFloat(this.gmOptions.lat), parseFloat(this.gmOptions.lng));
				this.gMap.setCenter(center);
				this.gmapMarker = new GMarker(center);
	      this.gMap.addOverlay(this.gmapMarker, {draggable : false});
			}
	},
	
	gmapPick : function(options, retfunc)
	{
    if(this._gmapDisp(options, {
			apply : function()
			        {
			          if(!this.gmapMarker) return;
			          var p = this.gmapMarker.getPoint();
                retfunc(p.lat(),p.lng(),this.gMap.getZoom());
                this.close();
							}.bind(this),
			cancel : function(){ this.close() }.bind(this)
		}))
		{
	  	this.gMapClickEvt = GEvent.addListener(this.gMap, "click", function(marker, point) {
			  if (this.gmapMarker) {
			    this.gMap.removeOverlay(this.gmapMarker);
			    this.gmapMarker = null;
			  } else {
	        this.gmapMarker = new GMarker(point, {draggable: true});
					this.gMap.addOverlay(this.gmapMarker);
			  	this.gMap.panTo(point);
			  }
			}.bind(this));
      this.gMap.setCenter(new GLatLng(parseFloat(this.gmOptions.lat), parseFloat(this.gmOptions.lng)));
			//this.gmapMarker = new GMarker(this.gMap.getCenter());
      //this.gMap.addOverlay(this.gmapMarker, {draggable : true});
		}
	},
	
	_gmapInit : function(options)
	{
	  if(!this.gmOptions)
	    this.gmOptions = {
			mapDivId   : 'gmap',
			ctlMapType : true,
			ctlLargeNav : true,
			ctlOverview : true,
			overviewSize : 140,
			mapTypeShortNames : false,
			type : G_NORMAL_MAP,
			marker : true,
			lat  : 0,
			lng  : 0,
			zoom : 3
		};
		$extend(this.gmOptions, options);
	  if(this.gMap) return true;
	  if (GBrowserIsCompatible()) {
      this.gMapDiv = new Element('div',{id:this.gmOptions.mapDivId}).injectInside(this.boxIn);
			this.gMap = new GMap2(this.gMapDiv);
			window.addListener('unload', GUnload);
			this.gMap.setCenter(new GLatLng(parseFloat(this.gmOptions.lat), parseFloat(this.gmOptions.lng)));
			this.gMapDiv.firstChild.nextSibling.firstChild.nextSibling.target = '_blank';
			if(this.gmOptions.ctlLargeNav)
	      this.gMap.addControl(new GLargeMapControl());
			if(this.gmOptions.ctlMapType)
			  this.gMap.addControl(new GMapTypeControl(parseInt(this.gmOptions.mapTypeShortNames)));
	  	this.gMap.enableContinuousZoom();
			GEvent.addDomListener(this.gMapDiv, "DOMMouseScroll", this._gmWheelZoomHandler.bind(this));
			GEvent.addDomListener(this.gMapDiv, "mousewheel", this._gmWheelZoomHandler.bind(this));
      GEvent.addListener(this.gMap, "mousemove", function(p){this.mouseLatLng = p}.bind(this));
      return true;
    }
    else
		  return false;
	},
	
	_gmapDisp : function(options, buttons)
	{
		if(!this._gmapInit(options))
		  return false;
		if(this.gmapMarker)
		{
		  this.gMap.removeOverlay(this.gmapMarker);
      this.gmapMarker = null;
		}
		if(this.gMapClickEvt)
		{
		  GEvent.removeListener(this.gMapClickEvt);
		  this.gMapClickEvt = null;
		}
		this.gMap.setMapType(this.gmOptions.type);
		this.gMap.setZoom(parseInt(this.gmOptions.zoom));
    this.messagebox(this.gMapDiv, null, buttons);
    this.gMap.checkResize();
		if(this.gmOptions.ctlOverview)  // here because buggy otherwise
		  this.gMap.addControl(new GOverviewMapControl(new GSize(this.gmOptions.overviewSize, this.gmOptions.overviewSize)));
		return true;
	},

	_gmWheelZoomHandler : function(e)
	{
	 	if (this.wheelZooming) return;
		this.wheelZooming = true;
		var evt = new Event(e);
		evt.stop();
		var p = (this.gmapMarker) ? this.gmapMarker.getPoint() : this.mouseLatLng;
		(evt.wheel > 0) ? this.gMap.zoomIn(p,true,true)
		                : this.gMap.zoomOut(p,true);
		this.wheelZooming = false;
		return false;
	}

});

Lightbox.implement(new Chain);
Lightbox.implement(new Events);
Lightbox.implement(new Options);

/* IMAGE SELECTOR */

var ImageSelector = new Class({

	getOptions: function(){
		return {
			container : '',
			image : '',
			classprefix : 'imgsel',
			baseZindex : 50,
			width : 200,
			height: 200,
			ratio : false,
			shiftratio : 1,
			marqueeH : '',
			marqueeV : '',
			start : [0,0,100,100], // x y w h
			limits : [0,0,0,0],    // minw minh maxw maxh
			onStart : Class.empty,
			onComplete : Class.empty,
			onPosition : Class.empty
		};
	},

	initialize: function(options){
		this.setOptions(this.getOptions(), options);
		if (this.options.initialize) this.options.initialize.call(this);
		// Create DOM elements
		this.rect = {};
		this.drags = {};
		this.isSelecting = false;

		this.container = new Element($(this.options.container), {
			styles :  {
									background : 'url(' + this.options.image + ') no-repeat top left',
									width      : this.options.width,
									height     : this.options.height
								},
			events :  {
			            mousedown : function(e)
															{
																if(this.isSelecting)
																	return;
																this.isSelecting = true;
                                var e = new Event(e);
																this._setPos({
																	l : e.page.x,
																	t : e.page.y,
																	r : e.page.x,
																	b : e.page.y,
																	dx : e.page.x,
																	dy : e.page.y
																});
															}.bind(this),
									mousemove : this._updSel.bind(this)
								}
		});

		this.overlay = new Element('div', {
			'class' : this.options.classprefix + '_overlay',
			styles : {
				'z-index'  : this.options.baseZindex + 1,
				width   : this.options.width,
				height  : this.options.height
			}
		}).injectInside(this.container);

    var handleStyle = {
    	position:'absolute',
    	'z-index'  : this.options.baseZindex + 3,
    	width:5,
    	height:5
    };

    this.handlediv = new Element('div',{
			id : this.options.classprefix + '_handlediv',
			styles : {display : 'none'}
		}).injectInside(document.body);

		this.handles  = {};

    Array('se','ne','nw','sw','n','s','e','w').each(function(id)
    {
      handleStyle['cursor'] = id + '-resize';
      this.handles[id] = new Element('div',{
				'class' : this.options.classprefix + '_handle',
				styles : handleStyle
			}).adopt(new Element('span')).injectInside(this.handlediv);
    }.bind(this));

		this.selector = new Element('div',{
		  styles : {
	    	'z-index'  : this.options.baseZindex + 2,
	      position   : 'absolute',
	    	cursor     : 'move',
	    	background : 'url(' + this.options.image + ') no-repeat top left'
			},
			events : {
				mouseover : function()
										{
								      if(!this.isSelecting) this.handlediv.setStyle('display','block');
										}.bind(this),
				mouseout  : function(e)
										{
										  if(new Event(e).relatedTarget.className != this.options.classprefix + '_handle' && !this.inDrag)
								        this.handlediv.setStyle('display','none');
										}.bind(this),
				mousemove : this._updSel.bind(this)
			}
		}).injectInside(document.body);

		document.addEvent('mouseup',this._endSel.bind(this));

    // Add marquee divs
    if(this.options.marqueeH && this.options.marqueeV)
    {
      var hsel = {
      	height:1,
      	width:'100%',
      	position:'absolute',
      	background:'url('+this.options.marqueeH+') repeat-x'
      };

      var vsel = {
      	height:'100%',
      	width:1,
      	position:'absolute',
      	background:'url('+this.options.marqueeV+') repeat-y'
      };

      this.selector.adopt(
        new Element('div').adopt(new Element('span')).setStyles(hsel).setStyle('top',-1)).adopt(
        new Element('div').adopt(new Element('span')).setStyles(hsel).setStyle('bottom',-1)).adopt(
        new Element('div').adopt(new Element('span')).setStyles(vsel).setStyle('right',-1)).adopt(
        new Element('div').adopt(new Element('span')).setStyles(vsel).setStyle('left',-1));
    }
		// Event hook for shift + drag constrained size
		if(!this.options.ratio)
		{
			document.addEvent('keydown', function(e)
			{
				if(new Event(e).shift) this.shiftdown = true;
			}.bind(this));
			document.addEvent('keyup', function(e)
			{
				if(!new Event(e).shift) this.shiftdown = false;
			}.bind(this));
		}

		var setStartPos = function(){
			this.absolutePos = this.container.getPosition();

			// Initial position and size of selection
		 	this._setPos({
				l : this.options.start[0] + this.absolutePos.x,
				t : this.options.start[1] + this.absolutePos.y,
				r : this.options.start[2] + this.options.start[0] + this.absolutePos.x,
				b : this.options.start[3] + this.options.start[1] + this.absolutePos.y,
				dx : 0,
				dy : 0
			});
		}.bind(this);

		window.addEvent('resize', setStartPos.bind(this));

		setStartPos();

		// Drag move handling for selection
    this.drags.selector = this._setDrag(this.selector, function()
		{
      this._setPos({
				l : this.drags.selector.value.now['x'],
				t : this.drags.selector.value.now['y'],
				r : this.drags.selector.value.now['x'] + this.rect.w,
				b : this.drags.selector.value.now['y'] + this.rect.h
			});
		});

	  // South East handle
    this.drags.se = this._setDrag(this.handles.se, function()
		{
      this._setPos({
				r : this.drags.se.value.now['x'],
				b : this.drags.se.value.now['y']
			});
		});

    // North West handle
    this.drags.nw = this._setDrag(this.handles.nw, function()
		{
      this._setPos({
				l : this.drags.nw.value.now['x'],
				t : this.drags.nw.value.now['y']
			});
		});
    // North East handle
    this.drags.ne = this._setDrag(this.handles.ne, function()
		{
      this._setPos({
				r : this.drags.ne.value.now['x'],
				t : this.drags.ne.value.now['y']
			});
		});
    // South West handle
    this.drags.sw = this._setDrag(this.handles.sw, function()
		{
      this._setPos({
				l : this.drags.sw.value.now['x'],
				b : this.drags.sw.value.now['y']
			});
		});
    // South handle
    this.drags.s = this._setDrag(this.handles.s, function()
		{
      this._setPos({
				b : this.drags.s.value.now['y']
			});
		});
    // North handle
    this.drags.n = this._setDrag(this.handles.n, function()
		{
      this._setPos({
				t : this.drags.n.value.now['y']
			});
		});
    // West handle
    this.drags.w = this._setDrag(this.handles.w, function()
		{
      this._setPos({
				l : this.drags.w.value.now['x']
			});
		});
    // East handle
    this.drags.e = this._setDrag(this.handles.e, function()
		{
      this._setPos({
				r : this.drags.e.value.now['x']
			});
		});

	},

	_endSel : function()
	{
	  if(!this.isSelecting) return;
		this.isSelecting = false;
	},

	_updSel : function(e)
	{
	  if(!this.isSelecting) return;
		var e = new Event(e);
		this._setPos({
			l : Math.min(this.rect.dx, e.page.x),
			t : Math.min(this.rect.dy, e.page.y),
			r : Math.max(this.rect.dx, e.page.x),
			b : Math.max(this.rect.dy, e.page.y)
		});
	},

	_setDrag : function(elem, func)
	{
	  // initialize drag for given element and selection-oriented handling
		func = func.bind(this);
	  return elem.makeDraggable({
	    snap       : 1,
		  container  : this.container,
      onStart    : function(){this.inDrag=true;this.fireEvent('onStart')}.bind(this),
      onComplete : function(){this.inDrag=false;this.fireEvent('onComplete')}.bind(this),
      onDrag     : function(){func();}.bind(this)
    });
	},

	_setPos : function(pos)
	{
		// Apply only changed values
		Object.extend(this.rect,pos);
		this.rect.w = this.rect.r - this.rect.l;
		this.rect.h = this.rect.b - this.rect.t;

		// Constrain size
		// A fixed ratio excludes use of shiftratio

		/*
		if(this.options.ratio)
		{
		  this.rect.h = this.rect.w * this.options.ratio;
		  if(this.rect.y + this.rect.h - this.absolutePos.y > this.options.height)
		  {
		    this.rect.h = this.options.height + this.absolutePos.y - this.rect.y;
		    this.rect.w = this.rect.h / this.options.ratio;
		  }
		}
		else if(this.shiftdown)
		{
		  this.rect.h = this.rect.w * this.options.shiftratio;
		  if(this.rect.y + this.rect.h - this.absolutePos.y > this.options.height)
		  {
		    this.rect.h = this.options.height + this.absolutePos.y - this.rect.y;
		    this.rect.w = this.rect.h / this.options.shiftratio;
		  }
	  }

	  */

	  // Apply size limits
		/*
		if(this.options.limits[0]) this.rect.w = Math.max(this.options.limits[0], this.rect.w);
	  if(this.options.limits[1]) this.rect.h = Math.max(this.options.limits[1], this.rect.h);
	  if(this.options.limits[2]) this.rect.w = Math.min(this.options.limits[2], this.rect.w);
		if(this.options.limits[3]) this.rect.h = Math.min(this.options.limits[3], this.rect.h);
		*/

		// To shorten code and avoid use of 'with'
	  var l = this.rect.l;
	  var t = this.rect.t;
	  var r = this.rect.r;
		var b = this.rect.b;
	  var w = this.rect.w;
		var h = this.rect.h;

		// Resize selected area and overlays
		this.selector.setStyles({
			top   : t,
			left  : l,
			width : w,
			height: h,
			'background-position' : Number(this.absolutePos.x - l) + 'px ' + Number(this.absolutePos.y - t) + 'px'
		});

		// Position handles
    [
      [this.handles.se, b-8, r-8],
      [this.handles.ne, t, r-8],
      [this.handles.sw, b-8, l],
  	  [this.handles.nw, t, l],
  		[this.handles.s, b-8, l+w/2-4],
      [this.handles.n, t, l+w/2-4],
      [this.handles.w, t+h/2-4, l],
  		[this.handles.e, t+h/2-4, r-8]
		].each(function(arr)
    {
      arr[0].setStyles({top:arr[1], left:arr[2]});
    });

		this.fireEvent('onPosition',[l - this.absolutePos.x,
                                 t - this.absolutePos.y,
                                 r - this.absolutePos.x,
                                 b - this.absolutePos.y,
																 w,
																 h]);
	}

});

ImageSelector.implement(new Options);
ImageSelector.implement(new Events);

/* STYLE SWITCHER */

var StyleSwitcher = {

	set : function(cssName, save)
	{
	  $$('link[rel^=alt]').each(function(css){
	    css.disabled = css.getAttribute('title') != cssName;
		});
		if(save) this.save(cssName);
	},

	get : function()
	{
	  $$('link[rel^=alt]').each(function(css){
	    if(css.disabled === false) return css.getAttribute('title');
		});
	},

	save : function(cssName)
	{
    Cookie.set('userstyle', (cssName) ? cssName : this.get(), {duration: {days: 365}});
	},

	load : function(apply)
	{
    var s = Cookie.get('userstyle');
    if(!s) return false;
    if(apply) this.set(s, false);
    return s;
	}

}

/* TRANSCORNERS */

var Transcorner = new Class({
	setOptions: function(options){
		this.options = Object.extend({
			radius: 10,
			borderColor: null,
			cornerColor: null,
			backgroundColor: this.el.getStyle('background-color'),
			transition: this.fx,
			onComplete: Class.empty
		}, options || {});
	}
	,initialize: function(el, sides, options) {
		this.el = $(el);
		if (!sides || $type(sides)=='object') {
			options = sides || false;
			sides = 'top, bottom';
		};
		this.setOptions(options);
		sides.split(',').each(function(side) {
			side = side.clean().test(' ') ? side.clean().split(' ') : [side.trim()];
			this.assemble(side[0], side[1]);
		}, this);
	}
	,fx: function(pos){
	    return -(Math.sqrt(1 - Math.pow(pos, 2)) - 1);
	}
	,assemble: function(vertical, horizontal) {
		var corner = this.options.cornerColor;
		var el = this.el;
		if(!corner)
		  while ((el = el.getParent()) && el.getTag()!='html' && [false, 'transparent'].test(corner = el.getStyle('background-color'))) {};
		var s = function(property, dontParse) {	return !dontParse ? (parseInt(this.el.getStyle(property)) || 0) : this.el.getStyle(property); }.bind(this);
		var sides = {
			left:'right',
			right:'left'
		};
		var styles = {
			display: 'block',
			backgroundColor: corner,
			zIndex: 1,
			position: 'relative',
			zoom: 1
		};
		for (side in sides) {styles['margin-' + side] = "-" + (s('padding-' + side) + s('border-' + side + '-width')) + "px";}
		for (side in {top:1, bottom:1}) {styles['margin-' + side] = vertical == side ? "0" : (s('padding-' + vertical) - this.options.radius) + "px";}
		var handler = new Element("b").setStyles(styles).addClass('corner-container');
		this.options.borderColor = this.options.borderColor || (s('border-'+vertical+'-width') > 0 ? s('border-'+vertical+'-color', 1) : this.options.backgroundColor);
		this.el.setStyle('border-'+vertical, '0').setStyle('padding-'+vertical, '0');
		var stripes = [];
		var borders = {};
		var exMargin = 0;
		for (side in sides) {borders[side] = s('border-' + side + '-width',1) + " " + s('border-' + side + '-style',1) + " " + s('border-' + side + '-color',1);}
		for (var i = 1; i < this.options.radius; i++) {
			margin = Math.round(this.options.transition((this.options.radius - i) / this.options.radius) * this.options.radius);
			var styles = {
				background: i==1 ? this.options.borderColor : this.options.backgroundColor,
				display: 'block',
				height: '1px',
        overflow: 'hidden',
				zoom: 1
			};
			for (side in sides) {
				var check = horizontal == sides[side];
				styles['border-' + side] = check ? borders[side] : (((exMargin || margin)-margin) || 1) + 'px solid ' + this.options.borderColor ;
				styles['margin-' + side] = check ? 0 : margin + 'px';
			};
			exMargin = margin;
			stripes.push(new Element("b").setStyles(styles).addClass('corner'));
		};
		if (vertical=='top') {this.el.insertBefore(handler, this.el.firstChild);}
		else {
			handler.injectInside(this.el);
			stripes = stripes.reverse();
		};
		stripes.each(function(stripe) {stripe.injectInside(handler);});
		this.options.onComplete();
	}
});
Element.extend({
	makeRounded: function(side, options){ return new Transcorner(this, side, options);	}
});