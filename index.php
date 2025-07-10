<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Timeline Generator - Professional Project Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated background particles */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo::before {
            content: "⚡";
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: white;
            transform: translateY(-2px);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Main container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 2rem 2rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Form container */
        .form-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        }

        .form-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #fff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-title p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Steps */
        .step {
            display: none;
            animation: fadeInUp 0.6s ease-out;
        }

        .step.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step h2 {
            color: white;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        input,
        select {
            width: 100%;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        select option {
            background: #1a1a2e;
            color: white;
        }

        /* Progress bar */
        .progress-container {
            margin-bottom: 2rem;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            width: 25%;
            transition: width 0.6s ease;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .progress-text {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Buttons */
        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: space-between;
            margin-top: 2rem;
        }

        button {
            flex: 1;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover:not(:disabled) {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }

        .btn-secondary:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Download section */
        .download-section {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
        }

        .download-message {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .download-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .download-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .download-button::before {
            content: "📁";
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .container {
                padding: 100px 1rem 1rem;
            }

            .form-container {
                padding: 2rem;
            }

            .form-title h1 {
                font-size: 2rem;
            }

            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Animated background -->
    <div class="bg-animation" id="bgAnimation"></div>

    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="#" class="logo">ProjectFlow</a>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="form-container">
            <div class="form-title">
                <h1>Project Timeline Generator</h1>
                <p>Create professional project timelines in minutes</p>
            </div>

            <!-- Progress bar -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                <div class="progress-text" id="progressText">Step 1 of 4</div>
            </div>

            <form id="multiStepForm">
                <!-- Step 1: Project Name -->
                <div class="step active" id="step1">
                    <h2>Project Details</h2>
                    <div class="form-group">
                        <label for="projectName">Project Name</label>
                        <input type="text" id="projectName" name="projectName" placeholder="Enter your project name" required>
                    </div>
                </div>

                <!-- Step 2: Date Selection -->
                <div class="step" id="step2">
                    <h2>Timeline Setup</h2>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" id="endDate" name="endDate" required>
                    </div>
                </div>

                <!-- Step 3: Framework Selection -->
                <div class="step" id="step3">
                    <h2>Framework Selection</h2>
                    <div class="form-group">
                        <label for="framework">Choose Your Framework</label>
                        <select id="framework" name="framework" required>
                            <option value="">Select a framework</option>
                            <option value="Agile">Agile - Flexible and iterative</option>
                            <option value="Waterfall">Waterfall - Sequential and structured</option>
                            <option value="Scrum">Scrum - Sprint-based collaboration</option>
                            <option value="Kanban">Kanban - Visual workflow management</option>
                        </select>
                    </div>
                </div>

                <!-- Step 4: Download Section -->
                <div class="step" id="step4">
                    <h2>Generate Timeline</h2>
                    <div class="download-section">
                        <div class="download-message" id="downloadMessage">
                            <span class="loading" id="loadingSpinner"></span>
                            <span id="messageText">Generating your Excel timeline...</span>
                        </div>
                        <a id="downloadLink" class="download-button" href="#" style="display: none;">
                            Download Excel File
                        </a>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="buttons">
                    <button type="button" class="btn-secondary" id="prevBtn" onclick="nextPrev(-1)" disabled>
                        Previous
                    </button>
                    <button type="button" class="btn-primary" id="nextBtn" onclick="nextPrev(1)">
                        Next
                    </button>
                    <button type="submit" class="btn-primary" id="submitBtn" style="display:none;">
                        Generate Timeline
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Create animated background particles
        function createParticles() {
            const bgAnimation = document.getElementById('bgAnimation');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                bgAnimation.appendChild(particle);
            }
        }

        // Multi-step form logic
        let currentStep = 1;
        const totalSteps = 4;

        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
            document.getElementById('progressText').textContent = `Step ${currentStep} of ${totalSteps}`;
        }

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));

            // Show current step
            document.getElementById(`step${step}`).classList.add('active');

            // Update navigation buttons
            document.getElementById('prevBtn').disabled = step === 1;
            document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'block';
            document.getElementById('submitBtn').style.display = step === totalSteps ? 'block' : 'none';

            updateProgress();
        }

        function nextPrev(direction) {
            const newStep = currentStep + direction;

            if (newStep < 1 || newStep > totalSteps) return;

            // Validate current step before moving
            if (direction === 1 && !validateStep(currentStep)) return;

            currentStep = newStep;
            showStep(currentStep);
        }

        function validateStep(step) {
            const inputs = document.querySelectorAll(`#step${step} input, #step${step} select`);
            let isValid = true;

            inputs.forEach(input => {
                if (input.required && !input.value.trim()) {
                    input.focus();
                    isValid = false;
                }
            });

            return isValid;
        }

        // Form submission
        document.getElementById('multiStepForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            document.getElementById('loadingSpinner').style.display = 'inline-block';
            document.getElementById('messageText').textContent = 'Generating your Excel timeline...';

            // Simulate file generation
            setTimeout(() => {
                // Hide loading
                document.getElementById('loadingSpinner').style.display = 'none';
                document.getElementById('messageText').textContent = 'Your timeline is ready!';

                // Show download link
                const downloadLink = document.getElementById('downloadLink');
                downloadLink.style.display = 'inline-flex';

                // Generate mock Excel file (in real implementation, you'd generate actual file)
                const projectName = document.getElementById('projectName').value;
                const blob = new Blob(['Mock Excel Content'], {
                    type: 'application/vnd.ms-excel'
                });
                const url = URL.createObjectURL(blob);
                downloadLink.href = url;
                downloadLink.download = `${projectName}_timeline.xlsx`;
            }, 2000);
        });

        // Date validation
        document.getElementById('startDate').addEventListener('change', function() {
            const endDate = document.getElementById('endDate');
            endDate.min = this.value;
        });

        document.getElementById('endDate').addEventListener('change', function() {
            const startDate = document.getElementById('startDate');
            if (startDate.value && this.value < startDate.value) {
                alert('End date cannot be before start date');
                this.value = '';
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            updateProgress();

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('startDate').min = today;
            document.getElementById('endDate').min = today;
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.15)';
                header.style.backdropFilter = 'blur(25px)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.1)';
                header.style.backdropFilter = 'blur(20px)';
            }
        });
    </script>
</body>

</html>