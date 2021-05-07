package  {

	import flash.display.Stage;
	import flash.display.Sprite;
	
	import flash.display.Loader;
	import flash.display.LoaderInfo;
	
	import flash.events.Event;
	import flash.events.DataEvent;
	import flash.events.MouseEvent;
	import flash.events.ProgressEvent;
	
	import flash.system.Security;

	import flash.net.FileReference;
	import flash.net.FileFilter;

	import flash.net.URLRequest;
	import flash.net.URLRequestMethod;
	import flash.net.URLVariables;

	import flash.external.ExternalInterface;
	
	import AttachmentFile;

	public class Attachment extends Sprite {
		
		var uploadrequest:URLRequest;
		
		public function Attachment() {
			Security.allowDomain("*");
			
			this.uploadrequest = new URLRequest(stage.loaderInfo.parameters.attach_url);
			this.uploadrequest.method = URLRequestMethod.POST;
			
			trigger.addEventListener(MouseEvent.CLICK, browse);
			trigger.addEventListener(MouseEvent.MOUSE_OVER, triggerover);
			trigger.addEventListener(MouseEvent.MOUSE_OUT, triggerout);

			trigger.buttonMode = true;
		}
		
		function browse(event:MouseEvent):void {
			var file:AttachmentFile = new AttachmentFile();
			var urlrequest:URLRequest = new URLRequest();

			file.id = "file-" + new Date().time;

			file.addEventListener(Event.SELECT, upload);
			file.addEventListener(Event.COMPLETE, complete);
			file.addEventListener(DataEvent.UPLOAD_COMPLETE_DATA, completedata);
			file.addEventListener(ProgressEvent.PROGRESS, progress);
			
			/*reference.addEventListener(DataEvent.UPLOAD_COMPLETE_DATA, handleComplete);
			reference.addEventListener(HTTPStatusEvent.HTTP_STATUS, handleHttpStatus);
			reference.addEventListener(IOErrorEvent.IO_ERROR, handleIoError);
			reference.addEventListener(SecurityErrorEvent.SECURITY_ERROR, handleSecurityError);*/
			
			var imageTypes:FileFilter = new FileFilter("Imagens (*.jpg, *.jpeg, *.gif, *.png)", "*.jpg; *.jpeg; *.gif; *.png");
			var textTypes:FileFilter = new FileFilter("Text Files (*.txt, *.rtf)", "*.txt; *.rtf");
			
			file.browse();
		}
		
		function upload(event:Event):void {
			var file:AttachmentFile = AttachmentFile(event.target);

			ExternalInterface.call(
				'app.attachment.add('
					+ '"' + stage.loaderInfo.parameters.attach_id + '"' + ','
					+ '"' + file.id + '"' + ','
					+ '"' + file.name + '"' + ','
					+ '"' + file.type + '"' + ','
					+ file.size
			  + ')'
			);

			event.target.upload(this.uploadrequest, 'data[Attachment]');
		}
		
		function complete(event:Event):void {
			var file:AttachmentFile = AttachmentFile(event.target);

			ExternalInterface.call(
				'app.attachment.complete('
					+ '"' + stage.loaderInfo.parameters.attach_id + '"' + ','
					+ '"' + file.id + '"'
			  + ')'
			);
		}
		
		function completedata(event:DataEvent):void {
			var file:AttachmentFile = AttachmentFile(event.target);

			ExternalInterface.call(
				'app.attachment.completedata('
					+ '"' + stage.loaderInfo.parameters.attach_id + '"' + ','
					+ '"' + file.id + '"' + ','
					+ '"' + event.data + '"'
			  + ')'
			);
		}
		
		function progress(event:ProgressEvent):void {
			var file:AttachmentFile = AttachmentFile(event.target);

			ExternalInterface.call(
				'app.attachment.progress('
					+ '"' + stage.loaderInfo.parameters.attach_id + '"' + ','
					+ '"' + file.id + '"' + ','
					+ '"' + (event.bytesLoaded/event.bytesTotal).toString() + '"'
			  + ')'
			);
		}
		
		function triggerover(event:MouseEvent):void {
			ExternalInterface.call(
				'app.attachment.triggerover("' + stage.loaderInfo.parameters.attach_id + '")'
			);
		}
		
		function triggerout(event:MouseEvent):void {
			ExternalInterface.call(
				'app.attachment.triggerout("' + stage.loaderInfo.parameters.attach_id + '")'
			);
		}

	}
	
}
