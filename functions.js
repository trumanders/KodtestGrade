var isLoginPressed = false;

function clearPlaceholderAndBorderStyle(element) {
  element.placeholder = "";
  element.style.borderColor = "";
}

function resetPlaceholderAndBorderStyle(element, placeHolderText, triedLogin) {
  element.placeholder = placeHolderText;
  if (triedLogin === true && element.value.trim() === "") {
    element.style.borderColor = "red";
  }
}
