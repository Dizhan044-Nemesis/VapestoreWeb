let display = document.getElementById('display');
let currentInput = '';
let resultDisplayed = false;
let operators = ['+', '-', '*', '/', '%', '^']; // Define all the operators

function append(value) {
    if (resultDisplayed) {
        clearDisplay();
        resultDisplayed = false;
    }

    // If the last character is an operator and the current input is also an operator
    if (operators.includes(value) && operators.includes(currentInput.slice(-1))) {
        currentInput = currentInput.slice(0, -1) + value; // Replace the last operator
    } else {
        currentInput += value; // Otherwise, append normally
    }

    display.innerText = currentInput;
}

function clearDisplay() {
    currentInput = '0';
    display.innerText = currentInput;
}

function calculate() {
    let expression = currentInput.replace('^', '**'); // Handle exponentiation
    try {
        currentInput = eval(expression).toString();
        display.innerText = currentInput;
        resultDisplayed = true;
    } catch (error) {
        display.innerText = 'Error';
        currentInput = '';
    }
}
