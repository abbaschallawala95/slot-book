// instruction page js
const instructionsText = {
    en: [
        "1. Please read all instructions carefully.",
        "2. Ensure that you understand the process completely.",
        "3. Follow all safety guidelines provided.",
        "4. Provide accurate information as required.",
        "5. Contact support if you need assistance.",
        "6. Contact support if you need assistance.",
        "7. Contact support if you need assistance.",
        "8. Contact support if you need assistance."
    ],
    gu: [
        "૧. કૃપા કરીને તમામ સૂચનાઓ ધ્યાનથી વાંચો.",
        "૨. ખાતરી કરો કે તમે પ્રક્રિયાને સંપૂર્ણપણે સમજ્યા છો.",
        "૩. આપવામાં આવેલી સુરક્ષા માર્ગદર્શિકાઓનું પાલન કરો.",
        "૪. જરૂરી માહિતી ચોક્કસપણે પૂરું પાડો.",
        "૫. મદદ માટે સપોર્ટનો સંપર્ક કરો.",
        "૬. મદદ માટે સપોર્ટનો સંપર્ક કરો.",
        "૭. મદદ માટે સપોર્ટનો સંપર્ક કરો.",
        "૮. મદદ માટે સપોર્ટનો સંપર્ક કરો."
    ]
};

function initializePage() {
    setLanguage('en'); // Set initial language to English
}
// Function to set the language
function setLanguage(lang) {
    const instructionsDiv = document.getElementById("instructions");
    const englishBtn = document.getElementById("englishBtn");
    const gujaratiBtn = document.getElementById("gujaratiBtn");

    // Update instructions text
    instructionsDiv.innerHTML = instructionsText[lang]
        .map(text => `<p>${text}</p>`)
        .join("");

        // Toggle button styles
        if (lang === 'en') {
            englishBtn.classList.add('btn-primary', 'active');
            englishBtn.classList.remove('btn-secondary');
            gujaratiBtn.classList.add('btn-secondary');
            gujaratiBtn.classList.remove('btn-primary', 'active');
        } else if (lang === 'gu') {
            gujaratiBtn.classList.add('btn-primary', 'active');
            gujaratiBtn.classList.remove('btn-secondary');
            englishBtn.classList.add('btn-secondary');
            englishBtn.classList.remove('btn-primary', 'active');
        }
}



function toggleNextButton() {
    const checkbox = document.getElementById('agreeCheckbox');
    const nextButton = document.getElementById('nextButton');
    if (checkbox.checked) {
        nextButton.classList.add('active');
        nextButton.disabled = false;
    } else {
        nextButton.classList.remove('active');
        nextButton.disabled = true;
    }
}

// start of slot selection 
const slots = {
    "2025-03-05": [
        "5 March 2025 8:30 - 9:00 am",
        "5 March 2025 9:00 - 9:30 am",
        "5 March 2025 9:30 - 10:00 am",
        "5 March 2025 10:00 - 10:30 am",
    ],
    "2025-03-06": [
        "6 March 2025 8:30 - 9:00 am",
        "6 March 2025 9:00 - 9:30 am",
        "6 March 2025 9:30 - 10:00 am",
        "6 March 2025 10:00 - 10:30 am",
    ],
    "2025-03-07": [
        "7 March 2025 8:30 - 9:00 am",
        "7 March 2025 9:00 - 9:30 am",
        "7 March 2025 9:30 - 10:00 am",
        "7 March 2025 10:00 - 10:30 am",
    ],
    "2025-03-08": [
        "8 March 2025 8:30 - 9:00 am",
        "8 March 2025 9:00 - 9:30 am",
        "8 March 2025 9:30 - 10:00 am",
        "8 March 2025 10:00 - 10:30 am",
    ],
    "2025-03-09": [
        "9 March 2025 8:30 - 9:00 am",
        "9 March 2025 9:00 - 9:30 am",
        "9 March 2025 9:30 - 10:00 am",
        "9 March 2025 10:00 - 10:30 am",
    ],
    "2025-03-10": [
        "10 March 2025 8:30 - 9:00 am",
        "10 March 2025 9:00 - 9:30 am",
        "10 March 2025 9:30 - 10:00 am",
        "10 March 2025 10:00 - 10:30 am",
    ],
};

function updateTimeSlots() {
    const dateSelect = document.getElementById("date");
    const timeSelect = document.getElementById("time");
    const selectedDate = dateSelect.value;
    console.log(selectedDate);
    

    // Clear existing options in time dropdown
    timeSelect.innerHTML = '<option value="" disabled selected>Select a time slot</option>';

    // Populate time dropdown with relevant slots
    if (selectedDate && slots[selectedDate]) {
        slots[selectedDate].forEach(slot => {
            const option = document.createElement("option");
            option.value = slot;
            option.textContent = slot;
            timeSelect.appendChild(option);
        });
    }
}

// end of slot selection

//dashboard page starts here


//dashboard page  ends here