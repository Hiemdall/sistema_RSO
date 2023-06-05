
document.getElementById('openPopup').addEventListener('click', function() {
var popup = document.querySelector('.popup');
popup.style.display = 'block';

var popupTexts = popup.getElementsByTagName('p');
for (var i = 0; i < popupTexts.length; i++) {
popupTexts[i].addEventListener('click', function() {
document.getElementById('observacion').value = this.innerText;
popup.style.display = 'none';
});
}

document.getElementById('cerrar').addEventListener('click', function() {
popup.style.display = 'none';
});
});