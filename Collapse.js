
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
    // content box is currently open, so close it
      content.style.display = "none";
    } else {
      content.style.display = "block";
      // content box is currently closed, so open it
    }
  });
}
