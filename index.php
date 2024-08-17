<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Timeline</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>

    <div class="container">
        <form id="multiStepForm">
            <!-- Step 1: Project Name -->
            <div class="step active">
                <h2>Project Name</h2>
                <label for="projectName">Enter Project Name:</label>
                <input type="text" id="projectName" name="projectName" required>
            </div>

            <!-- Step 2: Date Selection -->
            <div class="step">
                <h2>Date Selection</h2>
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>
            </div>

            <!-- Step 3: Framework Selection -->
            <div class="step">
                <h2>Select Framework</h2>
                <label for="framework">Choose a Framework:</label>
                <select id="framework" name="framework" required>
                    <option value="Agile">Agile</option>
                    <option value="Waterfall">Waterfall</option>
                    <option value="Scrum">Scrum</option>
                    <option value="Kanban">Kanban</option>
                </select>
            </div>

            <!-- Step 4: Download Section -->
            <div class="step">
                <h2>Download Excel File</h2>
                <p id="downloadMessage">Your Excel file is being generated. Please wait...</p>
                <a id="downloadLink" style="display: none;" href="#" class="download-button">Download Excel File</a>
            </div>

            <!-- Navigation Buttons -->
            <div class="buttons">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)" disabled>Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                <button type="submit" id="submitBtn" style="display:none;">Generate Excel</button>
            </div>
        </form>
    </div>
<script src="./assets/script.js"></script>
</body>

</html>