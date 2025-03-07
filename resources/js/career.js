
import { mbtiDetails } from './mbtiData.js';

        function startQuiz() {
        document.getElementById('instructions').style.display = "none";
        document.getElementById('start-btn').classList.add('hidden');
        document.getElementById('progress-bar-container').classList.remove('hidden');
        document.getElementById('quiz').classList.remove('hidden');
        navigateQuestion(); // Initialize the first question
    } 

        let currentQuestion = 1;
        const totalQuestions = 20;

        function navigateQuestion(direction) {
            if (direction === 'next' && !isAnswerSelected(currentQuestion)) {
                alert('Please select an answer before proceeding.');
                return;
            }
           
            // Hide the current question
            document.getElementById(`question-${currentQuestion}`).classList.add('hidden');

            // Update the question index
            if (direction === 'next' && currentQuestion < totalQuestions) {
                currentQuestion++;
            } else if (direction === 'prev' && currentQuestion > 1) {
                currentQuestion--;
            }

            // Show the new question
            document.getElementById(`question-${currentQuestion}`).classList.remove('hidden');

            // Update button visibility
            if (currentQuestion === 1) {
                document.getElementById('prev-btn').style.display = 'none'; // Hide "Previous" on first question
            } else {
                document.getElementById('prev-btn').style.display = 'inline-block';
            }
            
            if (currentQuestion === totalQuestions) {
                document.getElementById('next-btn').style.display = 'none'; // Hide "Next" on last question
                document.getElementById('submit-btn').style.display = 'inline-block'; // Show Submit
            } else {
                document.getElementById('next-btn').style.display = 'inline-block';
                document.getElementById('submit-btn').style.display = 'none';
            }
            // Update progress bar
            updateProgressBar();
        }

        function updateProgressBar() {
            const progress = (currentQuestion / totalQuestions) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
        }

        function isAnswerSelected(questionNumber) {
            return !!document.querySelector(`input[name="q${questionNumber}"]:checked`);
        }
        
        

        function calculateResult() {
            const answers = {};
            for (let i = 1; i <= totalQuestions; i++) {
                const selected = document.querySelector(`input[name="q${i}"]:checked`);
                if (selected) {
                    answers[`q${i}`] = selected.value;
                }
            }

            if (Object.keys(answers).length < totalQuestions) {
                alert('Please answer all questions.');
                return;
            }

            const mbtiCounts = { E: 0, I: 0, S: 0, N: 0, T: 0, F: 0, J: 0, P: 0 };
            const mbtiMapping = {
                q1: ['E', 'I'], // Question 1 determines Extroversion vs. Introversion
                q2: ['S', 'N'], // Question 2 determines Thinking vs. Feeling
                q3: ['T', 'F'], // Question 3 determines Judging vs. Perceiving
                q4: ['J', 'P'], // Question 4 determines Sensing vs. Intuition
                q5: ['E', 'I'], // Repeat for the remaining questions
                q6: ['S', 'N'],
                q7: ['T', 'F'],
                q8: ['J', 'P'],
                q9: ['E', 'I'],
                q10: ['S', 'N'],
                q11: ['T', 'F'],
                q12: ['J', 'P'],
                q13: ['E', 'I'],
                q14: ['S', 'N'],
                q15: ['T', 'F'],
                q16: ['J', 'P'],
                q17: ['E', 'I'],
                q18: ['S', 'N'],
                q19: ['T', 'F'],
                q20: ['J', 'P'],
            };


            for (const [question, selectedOption] of Object.entries(answers)) {
                const [optionA, optionB] = mbtiMapping[question];
                if (selectedOption === optionA) mbtiCounts[optionA]++;
                else if (selectedOption === optionB) mbtiCounts[optionB]++;
            }

            const mbtiType = 
                (mbtiCounts.E > mbtiCounts.I ? 'E' : 'I') +
                (mbtiCounts.S > mbtiCounts.N ? 'S' : 'N') +
                (mbtiCounts.T > mbtiCounts.F ? 'T' : 'F') +
                (mbtiCounts.J > mbtiCounts.P ? 'J' : 'P');

            

    
            const details = mbtiDetails[mbtiType];
            if (!details) {
                alert("MBTI type not found."); // Add graceful error handling
                return;
            }

            // I CHANEG HERE !!!!!!!!!!!!!!!!
            document.getElementById('personality-type').textContent = mbtiType;

            // Add sections dynamically
            document.getElementById("overview").innerHTML = details.overview.map(item => `<li>${item}</li>`).join('');
            document.getElementById("general-characteristics").innerHTML = details.generalCharacteristics.map(item => `<li>${item}</li>`).join('');
            document.getElementById("strengths").innerHTML = details.strengths.map(item => `<li>${item}</li>`).join('');
            document.getElementById("weaknesses").innerHTML = details.weaknesses.map(item => `<li>${item}</li>`).join('');
            
            // Add career suggestions
            document.getElementById("career-list").innerHTML = details.careerSuggestions.map(career => `<li>${career}</li>`).join('');

            // I CHANEG HERE !!!!!!!!!!!!!!!!

                document.getElementById("quiz").classList.add("hidden");
                document.getElementById("result").classList.remove("hidden");

            // Generate the graph with scores for all 8 traits
            const ctx = document.getElementById('mbti-chart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['E', 'I', 'S', 'N', 'T', 'F', 'J', 'P'],
                    datasets: [{
                        label: 'MBTI Scores',
                        data: [
                            mbtiCounts.E, mbtiCounts.I,
                            mbtiCounts.S, mbtiCounts.N,
                            mbtiCounts.T, mbtiCounts.F,
                            mbtiCounts.J, mbtiCounts.P
                        ],
                        backgroundColor: [
                            'rgb(231, 227, 78)', 'rgb(234, 190, 59)', 'rgb(240, 165, 142)', 'rgb(233, 115, 105)',
                            'rgb(107, 241, 209)', 'rgb(27, 213, 212)', 'rgb(236, 84, 141)', 'rgb(218, 76, 178)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                            stepSize: 1, // Increment by 1
                            precision: 0 // Force whole numbers only
                        }
                    
                    }
                }
            }
            });
        
        }
 async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Extract content
    const personalityType = document.getElementById("personality-type").textContent;
    
    // Extract each section separately
    const overview = Array.from(document.getElementById("overview").children).map(item => item.textContent).join("\n");
    const generalCharacteristics = Array.from(document.getElementById("general-characteristics").children).map(item => item.textContent).join("\n");
    const strengths = Array.from(document.getElementById("strengths").children).map(item => item.textContent).join("\n");
    const weaknesses = Array.from(document.getElementById("weaknesses").children).map(item => item.textContent).join("\n");
    const careerList = Array.from(document.getElementById("career-list").children).map(item => item.textContent);

    let y = 20; // Initial Y position

    // Title
    doc.setFont("Helvetica", "bold");
    doc.setFontSize(18);
    doc.text("MBTI Personality Report", 70, y);
    y += 12;

    // Personality Type
    doc.setFontSize(14);
    doc.text("Your Personality Type:", 10, y);
    doc.setFont("Helvetica", "normal");
    doc.text(personalityType, 70, y);
    y += 10;

    // Function to add sections dynamically
    function addSection(title, content) {
        doc.setFont("Helvetica", "bold");
        doc.text(title, 10, y);
        y += 7;
        doc.setFont("Helvetica", "normal");

        const contentLines = doc.splitTextToSize(content, 180);
        contentLines.forEach(line => {
            doc.text(line, 10, y);
            y += 7;
            if (y > 270) { doc.addPage(); y = 20; }
        });

        y += 5; // Space before next section
    }

    // Add sections
    addSection("Overview:", overview);
    addSection("General Characteristics:", generalCharacteristics);
    addSection("Strengths:", strengths);
    addSection("Potential Weaknesses:", weaknesses);

    // Career Paths
    doc.setFont("Helvetica", "bold");
    doc.text("Recommended Career Paths:", 10, y);
    y += 7;
    doc.setFont("Helvetica", "normal");

    careerList.forEach((career, index) => {
        doc.text(`${index + 1}. ${career}`, 10, y);
        y += 7;
        if (y > 270) { doc.addPage(); y = 20; }
    });

    // Add spacing before chart
    y += 10;

    // Chart (if exists)
    const chartCanvas = document.getElementById("mbti-chart");
    if (chartCanvas) {
        const chartImage = chartCanvas.toDataURL("image/png");

        doc.setFont("Helvetica", "bold");
        doc.text("Trait Scores:", 10, y);
        y += 10;

        doc.addImage(chartImage, "PNG", 10, y, 120, 60);
    }

    // Save the PDF
    doc.save("MBTI_Report.pdf");
}

        
        function restartQuiz() {
    // Reset the form
    document.getElementById('quiz-form').reset();

    // Hide all questions except the first one
    for (let i = 1; i <= totalQuestions; i++) {
        const question = document.getElementById(`question-${i}`);
        if (i === 1) {
            question.classList.remove('hidden'); // Show the first question
        } else {
            question.classList.add('hidden'); // Hide all other questions
        }
    }

    // Reset current question index
    currentQuestion = 1;

    // Reset button visibility
        // Ensure the "Previous" button is hidden
        const prevBtn = document.getElementById('prev-btn');
        if (prevBtn) {
            prevBtn.style.display = 'none';
        }
    
        // Ensure the "Next" button is visible
        const nextBtn = document.getElementById('next-btn');
        if (nextBtn) {
            nextBtn.style.display = 'inline-block';
        }
    
        // Ensure the "Submit" button is hidden
        const submitBtn = document.getElementById('submit-btn');
        if (submitBtn) {
            submitBtn.style.display = 'none';
        }


    // Reset progress bar
    document.getElementById('progress-bar').style.width = '0%';

    // Show quiz and hide result section
    document.getElementById('quiz').classList.remove('hidden');
    document.getElementById('result').classList.add('hidden');
}

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('start-btn').addEventListener("click", startQuiz);
            document.getElementById("next-btn").addEventListener("click", function () {
                navigateQuestion("next");
            });
            document.querySelectorAll('input[type="radio"]').forEach(input => {
                input.addEventListener("click", () => {
                    navigateQuestion("next"); // Move to the next question when an answer is clicked
                });
            });
            document.getElementById("prev-btn").addEventListener("click", function () {
                navigateQuestion("prev");
            });
            document.getElementById("submit-btn").addEventListener("click", calculateResult);
            const downloadBtn = document.querySelector(".btn-download");
            if (downloadBtn) {
                downloadBtn.removeEventListener("click", downloadPDF); // Remove existing listener
                downloadBtn.addEventListener("click", downloadPDF);
            }

            const restartBtn = document.getElementById('restart-btn');
            if (restartBtn) {
                restartBtn.addEventListener("click", restartQuiz);
                console.log("Restart button event listener added");
            } else {
                console.error("Restart button not found!");
            }
            document.getElementById("start-instructions").addEventListener("click", function() {
                document.getElementById("test-section").style.display = "none";  // Hide test section
                document.getElementById("images-section").style.display = "none";  // Hide images
                document.getElementById("instructions").style.display = "block";  // Show instructions
            });
     });
  
