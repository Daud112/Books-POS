function preview() {
  frame.src = URL.createObjectURL(event.target.files[0]);
}
function clearImage() {
  document.getElementById('coverImage').value = null;
  frame.src = "";
}