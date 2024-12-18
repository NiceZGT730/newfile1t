const events = document.querySelectorAll('.event');
const dropZones = document.querySelectorAll('.drop-zone');
const checkOrderButton = document.getElementById('checkOrder');
const clearAnswersButton = document.getElementById('clearAnswers');
const resultDiv = document.getElementById('result');

// Store original positions of events
const originalEvents = Array.from(events).map(event => {
    return { element: event, parent: event.parentElement };
});

let draggedEvent = null;

// Modal elements
const messageModal = document.getElementById('messageModal');
const closeModalButton = document.getElementById('closeModal');

// Allow dragging of events
events.forEach(event => {
    event.addEventListener('dragstart', (e) => {
        draggedEvent = e.target;
        e.dataTransfer.effectAllowed = 'move';
    });
});

// Allow dropping on drop zones
dropZones.forEach(zone => {
    zone.addEventListener('dragover', (e) => {
        e.preventDefault(); // Prevent default to allow drop
        e.dataTransfer.dropEffect = 'move';
    });

    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        
        if (zone.children.length < 1) {
            // If the drop zone is empty, append the dragged event
            zone.appendChild(draggedEvent);
        } else {
            // If the drop zone already has an event, swap the events
            const existingEvent = zone.firstChild;
            zone.appendChild(draggedEvent);
            zone.appendChild(existingEvent);
        }
    });
});

// Check order button functionality
checkOrderButton.addEventListener('click', () => {
    const correctOrderGeocentric = ['1', '2', '3', '4', '5'];
    const correctOrderHeliocentric = ['6', '7', '8', '9', '10'];

    // Check if all drop zones are filled
    const allFilled = Array.from(dropZones).every(zone => zone.children.length > 0);

    if (!allFilled) {
        // Show modal instead of setting text in resultDiv
        messageModal.style.display = "block"; 
        return; // Exit the function if not all are filled
    }

    let userOrderGeocentric = Array.from(document.querySelectorAll('#geo-zone1 .event, #geo-zone2 .event, #geo-zone3 .event, #geo-zone4 .event, #geo-zone5 .event'))
        .map(event => event.getAttribute('data-order'));
    
    let userOrderHeliocentric = Array.from(document.querySelectorAll('#helio-zone1 .event, #helio-zone2 .event, #helio-zone3 .event, #helio-zone4 .event, #helio-zone5 .event'))
        .map(event => event.getAttribute('data-order'));
    
    // Clear previous styles
    dropZones.forEach(zone => {
        zone.style.backgroundColor = ''; // Reset background color
    });

    // Check correctness for Geocentric events
    userOrderGeocentric.forEach((order, index) => {
        if (dropZones[index].children.length > 0) { // Check if the drop zone is filled
            if (order === correctOrderGeocentric[index]) {
                dropZones[index].style.backgroundColor = 'lightgreen'; // Correct
            } else {
                dropZones[index].style.backgroundColor = 'lightcoral'; // Incorrect
            }
        }
    });

    // Check correctness for Heliocentric events
    userOrderHeliocentric.forEach((order, index) => {
        if (dropZones[index + 5].children.length > 0) { // Check if the drop zone is filled
            if (order === correctOrderHeliocentric[index]) {
                dropZones[index + 5].style.backgroundColor = 'lightgreen'; // Correct
            } else {
                dropZones[index + 5].style.backgroundColor = 'lightcoral'; // Incorrect
            }
        }
    });

    // Display final result
    const isGeocentricCorrect = JSON.stringify(userOrderGeocentric) === JSON.stringify(correctOrderGeocentric);
    const isHeliocentricCorrect = JSON.stringify(userOrderHeliocentric) === JSON.stringify(correctOrderHeliocentric);

    if (isGeocentricCorrect && isHeliocentricCorrect) {
        resultDiv.textContent = "ยอดเยี่ยม! คุณจัดเรียงเหตุการณ์ได้ถูกต้องทั้งหมด!";
        resultDiv.style.color = "green";
    } else {
        resultDiv.textContent = "ลองอีกครั้ง! คุณยังมีบางเหตุการณ์ที่ไม่ถูกต้อง.";
        resultDiv.style.color = "red";
    }
});

// Clear answers button functionality
clearAnswersButton.addEventListener('click', () => {
    // Remove all events from drop zones
    dropZones.forEach(zone => {
        while (zone.firstChild) {
            zone.removeChild(zone.firstChild);
        }
        zone.style.backgroundColor = ''; // Reset background color
    });

    // Reset all events to their original positions
    originalEvents.forEach(({ element, parent }) => {
        parent.appendChild(element);
    });

    // Reset the result message
    resultDiv.textContent = '';
});

// Close modal when clicking on the close button
closeModalButton.addEventListener('click', () => {
    messageModal.style.display = "none"; // Hide modal
});

// Close modal when clicking outside of the modal content
window.addEventListener('click', (event) => {
    if (event.target === messageModal) {
        messageModal.style.display = "none"; // Hide modal
    }
});
