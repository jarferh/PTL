let currentStep = 0;
showStep(currentStep);

function showStep(n) {
    const steps = document.getElementsByClassName("step");
    steps[n].classList.add("active");

    document.getElementById("prevBtn").style.display = n === 0 ? "none" : "inline";
    document.getElementById("nextBtn").style.display = n === (steps.length - 2) ? "none" : "inline";
    document.getElementById("submitBtn").style.display = n === (steps.length - 2) ? "inline" : "none";

    // document.getElementById("nextBtn").textContent = n === (steps.length - 2) ? "Generate Excel" : "Next";
}

function nextPrev(n) {
    const steps = document.getElementsByClassName("step");
    steps[currentStep].classList.remove("active");
    currentStep += n;
    showStep(currentStep);
}

document.getElementById("multiStepForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('generate_excel.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("downloadMessage").textContent = "Your Excel file is ready for download!";
                const downloadLink = document.getElementById("downloadLink");
                downloadLink.href = data.file_url;
                downloadLink.style.display = "inline-block";
            } else {
                document.getElementById("downloadMessage").textContent = "An error occurred while generating the Excel file. Please try again.";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById("downloadMessage").textContent = "An error occurred. Please try again.";
        });

    nextPrev(1);
});