/**
 * Turn on the camera，and then the button disappeaer
 */
 let mediaStreamTrack = null; // Video objects (global)

 function showCamera() {
	 $(".bg-content").css("display", "block");
	 let constraints = {
		 video: {
			 width: 600,
			 height: 600,
			 facingMode:"environment" //Preferential use of the rear camera.
		 },
		 audio: true
	 };
	 //Get the video camera area
	 let video = document.getElementById("video");


 
	 let promise = navigator.mediaDevices.getUserMedia(constraints);
 
	 promise.then(function (MediaStream) {
		 mediaStreamTrack = typeof MediaStream.stop === 'function' ? MediaStream : MediaStream.getTracks()[1];
		 video.srcObject = MediaStream;
		 video.muted = true;
		 video.play();
		
	 });

	document.getElementById("disappear").style.display="none";//to make the button 'Scan Artwork' disappear.
	
 }
 
/**
 * （simulation of identifying art collection）just jump to ranking page.
 */
function jumpToInfo() {
	location.href="ranking.html";

}



