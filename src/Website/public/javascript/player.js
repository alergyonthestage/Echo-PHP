var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var ytPlayer

function onYouTubeIframeAPIReady() {
    ytPlayer = new YT.Player('player', {
        height: '360',
        width: '640',
        events: {
            'onReady': (event) => event.target.playVideo(),
        }
    });
}