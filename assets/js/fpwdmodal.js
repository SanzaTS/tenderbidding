// MODAL
// -----
var Modal = (function() {
    var openedModal;
  
    return {
      open: open,
      close: close,
      change: change,
      alert: alert
    };
  
    function open(target, callback) {
      document.documentElement.classList.add("is-scroll-disabled");
      openedModal = document.querySelector(target);
      openedModal.dataset.opened = "true";
      callback && callback(openedModal);
  
      // Add youtube iframe video src or video src
      // if (openedModal.dataset.video) {
      //   if (openedModal.dataset.video.includes("youtube")) {
      //     var vParam = openedModal.dataset.video.split("v=");
      //     var videoId = vParam[1].includes("&")
      //       ? vParam[1].substr(0, vParam[1].indexOf("&"))
      //       : vParam[1];
      //     var embed =
      //       "https://www.youtube.com/embed/" +
      //       videoId +
      //       "?rel=0&amp;controls=1&amp;showinfo=0&amp;autoplay=1";
      //     openedModal.querySelector("iframe").src = embed;
      //   } else {
      //     openedModal.querySelector("video").src = openedModal.dataset.video;
      //   }
      // }
  
      // Add iframe src
      // if (openedModal.dataset.iframe) {
      //   openedModal.querySelector("iframe").src = openedModal.dataset.iframe;
      // }
    }
  
    function close(event, callback) {
      if (event) {
        event.preventDefault(), event.stopPropagation();
        if (!event.target.dataset.hasOwnProperty("modalClose")) return;
      }
  
      document.documentElement.classList.remove("is-scroll-disabled");
      openedModal.dataset.opened = "false";
  
      // // Remove video iframe url or iframe src
      // if (openedModal.dataset.iframe) {
      //   openedModal.querySelector("iframe").src = "";
      // }
  
      // // Remove video iframe src or video src
      // if (openedModal.dataset.video) {
      //   if (openedModal.dataset.video.includes("youtube")) {
      //     openedModal.querySelector("iframe").src = "";
      //   } else {
      //     var video = openedModal.querySelector("video");
      //     video.pause();
      //     video.currentTime = 0;
      //   }
      // }
  
      callback && callback(openedModal);
    }
  
    function change(target, event) {
      event && (event.preventDefault(), event.stopPropagation());
      openedModal.dataset.opened = "false";
      openedModal = document.querySelector(target);
      openedModal.dataset.opened = "true";
    }
  
    function alert(element, text) {
      open(element, function(element) {
        text && (element.querySelector(".modal--content").innerHTML = text);
      });
    }
  })();
  