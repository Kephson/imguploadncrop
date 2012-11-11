var ias='';
var movestep=10;
var imgoptions='';
$(document).ready(function() {
	
	$('#selLeft').click(function(){
		moveSelection('l');
	});
	
	$('#selRight').click(function(){
		moveSelection('r');
	});
	
	$('#selUp').click(function(){
		moveSelection('u');
	});
	
	$('#selDown').click(function(){
		moveSelection('d');
	});
	
	$('#selResize').click(function(){
		moveSelection('x');
	});
	
	$('#selResizeSmall').click(function(){
		moveSelection('y');
	});
	
});

function moveSelection(direction){
	ias = $('#big').imgAreaSelect({instance:true}); // get the imgareaselect
	
	if(typeof(ias)  === "undefined"){}//do nothing if there is no imgareaselect
	
	else {
		
		imgoptions=ias.getOptions();// get the options
		var newx1=0;
		var newx2=0;
		var newy1=0;
		var newy2=0;
		splitRatio=imgoptions.aspectRatio.split(':');// the ratio for resizing the selection

		// Debug log
		//console.log('x1:'+imgoptions.x1+'-y1:'+imgoptions.y1+'-x2:'+imgoptions.x2+'-y2:'+imgoptions.y2);

		// move left
		if(direction=='l'){
			if(imgoptions.x1>movestep){
				newx1=imgoptions.x1-movestep;
				newx2=imgoptions.x2-movestep;
				newy1=imgoptions.y1;
				newy2=imgoptions.y2;
			}
			else {
				newx1=0;
				newx2=imgoptions.x2-imgoptions.x1;
				newy1=imgoptions.y1;
				newy2=imgoptions.y2;
			}
		}

		// move right
		if(direction=='r'){
			if((imgoptions.x2+movestep)>imgoptions.maxWidth){
				newx1=imgoptions.maxWidth-(imgoptions.x2-imgoptions.x1);
				newx2=imgoptions.maxWidth;
				newy1=imgoptions.y1;
				newy2=imgoptions.y2;
			}
			else {
				newx1=imgoptions.x1+movestep;
				newx2=imgoptions.x2+movestep;
				newy1=imgoptions.y1;
				newy2=imgoptions.y2;
			}
		}

		// move up
		if(direction=='u'){
			if(imgoptions.y1>movestep){
				newx1=imgoptions.x1;
				newx2=imgoptions.x2;
				newy1=imgoptions.y1-movestep;
				newy2=imgoptions.y2-movestep;
			}
			else {
				newx1=imgoptions.x1;
				newx2=imgoptions.x2;
				newy1=0;
				newy2=imgoptions.y2-imgoptions.y1;
			}
		}

		// move down
		if(direction=='d'){
			if((imgoptions.y2+movestep)>imgoptions.maxHeight){
				newx1=imgoptions.x1;
				newx2=imgoptions.x2;
				newy1=imgoptions.maxHeight-(imgoptions.y2-imgoptions.y1);
				newy2=imgoptions.maxHeight;
			}
			else {
				newx1=imgoptions.x1;
				newx2=imgoptions.x2;
				newy1=imgoptions.y1+movestep;
				newy2=imgoptions.y2+movestep;
			}
		}

		// make selection bigger to right and bottom
		if(direction=='x'){
			if(((imgoptions.x2+movestep)<=imgoptions.maxWidth)&&((imgoptions.y2+movestep)<=imgoptions.maxHeight)){
				newx1=imgoptions.x1;
				newx2=imgoptions.x2+movestep*splitRatio[0];
				newy1=imgoptions.y1;
				newy2=imgoptions.y2+movestep*splitRatio[1];
			}
			else {
				newx1=imgoptions.x1;
				newx2=imgoptions.x2;
				newy1=imgoptions.y1;
				newy2=imgoptions.y2;
			}
		}

		// make selection smaller from right and bottom
		if(direction=='y'){
			if(((imgoptions.x2-movestep)>=imgoptions.minWidth)&&((imgoptions.y2-movestep)>=imgoptions.minHeight)){
				newx1=imgoptions.x1;
				newx2=imgoptions.x2-movestep*splitRatio[0];
				newy1=imgoptions.y1;
				newy2=imgoptions.y2-movestep*splitRatio[1];
			}
			else {
				newx1=imgoptions.x1;
				newx2=imgoptions.x2;
				newy1=imgoptions.y1;
				newy2=imgoptions.y2;
			}
		}

		ias.setOptions({
			x1:newx1,x2:newx2,
			y1:newy1,y2:newy2,
			aspectRatio:imgoptions.aspectRatio,
			show:imgoptions.show,
			handles:imgoptions.handles,
			fadeSpeed:imgoptions.fadeSpeed,
			resizeable:imgoptions.resizeable,
			maxHeight:imgoptions.maxHeight,
			maxWidth:imgoptions.maxWidth,			
			minHeight:imgoptions.minHeight,
			minWidth:imgoptions.minWidth,
			persistent:imgoptions.persistent,
			onSelectChange:imgoptions.onSelectChange
		});
		ias.update();
		previewMobile(imgoptions);
		
	}
}

function previewMobile(imgoptions) {
	swidth=imgoptions.x2-imgoptions.x1;
	sheight=imgoptions.y2-imgoptions.y1;
    $('.x1').val(imgoptions.x1*sizefactor);
    $('.y1').val(imgoptions.y1*sizefactor);
    $('.x2').val(imgoptions.x2*sizefactor);
    $('.y2').val(imgoptions.y2*sizefactor);
    $('.width').val(swidth*sizefactor);
    $('.height').val(sheight*sizefactor);
	$('#preview').css({'width':swidth+'px','height':sheight+'px'});
	selWidth=swidth;
	selHeight=sheight;
	$('#preview img').css({'left':'-'+imgoptions.x1+'px','top':'-'+imgoptions.y1+'px'});
}