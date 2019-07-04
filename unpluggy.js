function loadBlocksAndRun() {

  	var xml_text = $('#xmlWrapper').html();		
	var xml = Blockly.Xml.textToDom(xml_text);		

	Blockly.mainBlockSpace.clear();
	Blockly.Xml.domToBlockSpace(Blockly.mainBlockSpace, xml);

	$('#runButton').click();

}

function extractXmlFromBlockSpace() {

	var xml = Blockly.Xml.blockSpaceToDom(Blockly.mainBlockSpace);
	var xml_text = Blockly.Xml.domToPrettyText(xml);
	var codeXML = $('<div/>').text(xml_text).html();
	
	$("#show-code-header").click();
	$('.generated-code-container').append('<pre class="generatedCode" dir="ltr"><textarea style="width:96%;height:200px;">' + codeXML + '</textarea></pre>');
		
}

function initPreLoad() {

	try {
    	Blockly.mainBlockSpace.clear();	
		var xml = Blockly.Xml.textToDom('<xml id="startBlocks"><block type="when_run" deletable="false" movable="false"></xml>');
		Blockly.Xml.domToBlockSpace(Blockly.mainBlockSpace, xml);

		sessionStorage.setItem('video',{C1_bee_level_intro: false});
		
		if (autorun) {
			setTimeout(function() {
				$("#x-close, .csf-top-instructions button").click();				
				loadBlocksAndRun();

			},3000);
		}
		
		console.log("Success");		
		
    } catch(e) {
    	console.log('Exception');
    	setTimeout(initPreLoad,50);
    }

}

document.addEventListener("DOMContentLoaded", initPreLoad);

$('#myButton').bind('click', loadBlocksAndRun);
$('#extractButton').bind('click', extractXmlFromBlockSpace);