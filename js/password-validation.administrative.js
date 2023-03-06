const password = document.getElementById("password");
const characterMinMax_validation = document.getElementById(
  "characterMinMax-validation"
);
const lowercase_validation = document.getElementById(
  "lowercase-validation"
);
const uppercase_validation = document.getElementById(
  "uppercase-validation"
);
const numeric_validation = document.getElementById("numeric-validation");
const specialCharacter_validation = document.getElementById(
  "specialCharacter-validation"
);
defaultMessage();

function initPasswordValidation(element){
  element.addEventListener("input", (e) => {
    const validation = document.querySelectorAll(".validation-message");
    validation.forEach((e) => {
      e.innerHTML = "";
      const div = document.createElement("div");
      div.classList.add("loader");
      e.append(div);
    });
    CheckPassword(e.target.value);
  });
}
function CheckPassword(inputtxt) {
  const textLenght = inputtxt.length;
  const lowercase = /^(?=.*[a-z])/;
  const uppercase = /^(?=.*[A-Z])/;
  const numeric = /^(?=.*[0-9])/;
  const specialCharacter = /^(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?])/;
  const timeout = setTimeout(() => {
    if (!inputtxt) {
      defaultMessage();
      return;
    }
    const validation = {
      textLenght: textLenght,
      lowercase: lowercase,
      uppercase: uppercase,
      numeric: numeric,
      specialCharacter: specialCharacter,
    };
    validationStatus(inputtxt, validation);
    showValidationMessage(inputtxt, validation);
    clearTimeout(timeout);
  }, 500);
}
function showValidationMessage(inputtxt, validation) {
  const { textLenght, lowercase, uppercase, numeric, specialCharacter } =
    validation;
  if (textLenght > 30 || textLenght < 8) {
    return password.setCustomValidity(
      "Minimum of 8 & maximum of 30 characters"
    );
  } else {
    password.setCustomValidity("");
  }
  if (!inputtxt.match(lowercase)) {
    return password.setCustomValidity("At least 1 lowercase letter");
  } else {
    password.setCustomValidity("");
  }
  if (!inputtxt.match(uppercase)) {
    return password.setCustomValidity("At least 1 uppercase letter");
  } else {
    password.setCustomValidity("");
  }
  if (!inputtxt.match(numeric)) {
    return password.setCustomValidity("At least 1 numeric digit");
  } else {
    password.setCustomValidity("");
  }
  if (!inputtxt.match(specialCharacter)) {
    return password.setCustomValidity("At least 1 special character");
  } else {
    password.setCustomValidity("");
  }
}
function validationStatus(inputtxt, validation) {
  const errorIcon = `<svg
version="1.1"
xmlns="http://www.w3.org/2000/svg"
viewBox="0 0 130.2 130.2"
>
<circle
  class="path circle"
  fill="none"
  stroke="#D06079"
  stroke-width="6"
  stroke-miterlimit="10"
  cx="65.1"
  cy="65.1"
  r="62.1"
/>
<line
  class="path line"
  fill="none"
  stroke="#D06079"
  stroke-width="6"
  stroke-linecap="round"
  stroke-miterlimit="10"
  x1="34.4"
  y1="37.9"
  x2="95.8"
  y2="92.3"
/>
<line
  class="path line"
  fill="none"
  stroke="#D06079"
  stroke-width="6"
  stroke-linecap="round"
  stroke-miterlimit="10"
  x1="95.8"
  y1="38"
  x2="34.4"
  y2="92.2"
/>
</svg>
`;
  const successIcon = ` <svg
version="1.1"
xmlns="http://www.w3.org/2000/svg"
viewBox="0 0 130.2 130.2"
>
<circle
  class="path circle"
  fill="none"
  stroke="#73AF55"
  stroke-width="6"
  stroke-miterlimit="10"
  cx="65.1"
  cy="65.1"
  r="62.1"
/>
<polyline
  class="path check"
  fill="none"
  stroke="#73AF55"
  stroke-width="6"
  stroke-linecap="round"
  stroke-miterlimit="10"
  points="100.2,40.2 51.5,88.8 29.8,67.5 "
/>
</svg>`;

  const { textLenght, lowercase, uppercase, numeric, specialCharacter } =
    validation;

  if (textLenght > 30 || textLenght < 8) {
    characterMinMax_validation.innerHTML = errorIcon;
  } else {
    characterMinMax_validation.innerHTML = successIcon;
  }
  if (!inputtxt.match(lowercase)) {
    lowercase_validation.innerHTML = errorIcon;
  } else {
    lowercase_validation.innerHTML = successIcon;
  }
  if (!inputtxt.match(uppercase)) {
    uppercase_validation.innerHTML = errorIcon;
  } else {
    uppercase_validation.innerHTML = successIcon;
  }
  if (!inputtxt.match(numeric)) {
    numeric_validation.innerHTML = errorIcon;
  } else {
    numeric_validation.innerHTML = successIcon;
  }
  if (!inputtxt.match(specialCharacter)) {
    specialCharacter_validation.innerHTML = errorIcon;
  } else {
    specialCharacter_validation.innerHTML = successIcon;
  }
}
function defaultMessage() {
  characterMinMax_validation.textContent = "Required";
  lowercase_validation.textContent = "Required";
  uppercase_validation.textContent = "Required";
  numeric_validation.textContent = "Required";
  specialCharacter_validation.textContent = "Required";
}

initPasswordValidation(password);
