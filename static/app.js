var role = document.getElementsByName("role")[0]
var loginForm = document.getElementsByClassName("additional-form-group")[0]


function removeAllElements() {
  while (loginForm.hasChildNodes()) {
    loginForm.removeChild(loginForm.lastChild)
  }
}

function addElement(cont, name) {
  var div = document.createElement("div")
  var label = document.createElement("label")
  label.textContent = cont
  var input = document.createElement("input")
  input.setAttribute("name", name)
  div.appendChild(label)
  div.appendChild(input)
  loginForm.appendChild(div)
}

role.addEventListener("change", () => {
  removeAllElements()
  if (role.value === "interviewer") {
    addElement("Company you are currently working for", "additionalField1")
    addElement("Years of Experience","additionalField2")
  }
  else {
    addElement("You are currently a", "additionalField1");
    addElement("Skills you have", "additionalField2");
  }
})