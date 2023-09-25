function showPopup(event) {
    event.preventDefault();
    var popup = document.getElementById("popup");
    popup.classList.remove("hidden");
}
function hidePopup() {
    var popup = document.getElementById("popup");
    popup.classList.add("hidden");
}
function toggleButton() {
    var checkbox = document.querySelector('input[type="checkbox"]');
    var button = document.getElementById("reserve-button");
    if (checkbox.checked) {
        button.style.display = "block";
    }
    else {
        button.style.display = "none";
    }
}



function validateDateRange() {
    var startDateInput = document.getElementById('start-date');
    var endDateInput = document.getElementById('end-date');
    var minDaysInput = document.getElementById('min-days');

    var startDate = new Date(startDateInput.value);
    var endDate = new Date(endDateInput.value);
    var minDays = parseInt(minDaysInput.value);

    if (endDate < startDate) {
    alert("End date cannot be less than start date!");
    endDateInput.value = startDateInput.value;
    }
    var diffInDays = Math.floor((Date.parse(endDate) - Date.parse(startDate)) / 86400000);
    if (diffInDays < minDays) {
    alert("Minimum number of days is " + minDays + ", please select a longer date range.");
    startDate.setDate(startDate.getDate() + minDays);
    var endDateValue = startDate.toISOString().slice(0,10);
    endDateInput.value = endDateValue;
    }
}   

const particuliereCheckbox = document.getElementById("particuliere-checkbox");
const daysOfWeekContainer = document.getElementById("days-of-week-container");
const mondayCheckbox = document.getElementById("monday");
const tuesdayCheckbox = document.getElementById("tuesday");
const wednesdayCheckbox = document.getElementById("wednesday");
const thursdayCheckbox = document.getElementById("thursday");
const fridayCheckbox = document.getElementById("friday");
const saturdayCheckbox = document.getElementById("saturday");
const sundayCheckbox = document.getElementById("sunday");
particuliereCheckbox.addEventListener("change", function() {
  if (this.checked) {
    daysOfWeekContainer.style.display = "block";
  } else {
    daysOfWeekContainer.style.display = "none";
  }
});

function updateDisponibility() {
    const startDate = new Date(document.getElementById("start-date").value);
    const endDate = new Date(document.getElementById("end-date").value);
    
    // Disable checkboxes for days outside the range
    if (startDate && endDate) {
      if (mondayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "monday");
        mondayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          mondayCheckbox.checked = false;
        }
      }
      if (tuesdayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "tuesday");
        tuesdayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          tuesdayCheckbox.checked = false;
        }
      }
      if (wednesdayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "wednesday");
        wednesdayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          wednesdayCheckbox.checked = false;
        }
      }
      if (thursdayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "thursday");
        thursdayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          thursdayCheckbox.checked = false;
        }
      }
      if (fridayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "friday");
        fridayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          fridayCheckbox.checked = false;
        }
      }
      if (saturdayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "saturday");
        saturdayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          saturdayCheckbox.checked = false;
        }
      }
      if (sundayCheckbox) {
        const isInRange = isDayInRange(startDate, endDate, "sunday");
        sundayCheckbox.disabled = !isInRange;
        if (!isInRange) {
          sundayCheckbox.checked = false;
        }
      }
    }
  }
  
  function isDayInRange(startDate, endDate, dayOfWeek) {
    const daysOfWeek = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    const dayIndex = daysOfWeek.indexOf(dayOfWeek.toLowerCase());
    const startDay = new Date(startDate.getTime() + ((dayIndex - startDate.getDay() + 7) % 7) * 86400000);
    const endDay = new Date(endDate.getTime() + ((dayIndex - endDate.getDay() + 7) % 7) * 86400000);
    return startDate <= endDay && endDate >= startDay;
  }
  
  document.getElementById("start-date").addEventListener("change", updateDisponibility);
  document.getElementById("end-date").addEventListener("change", updateDisponibility);