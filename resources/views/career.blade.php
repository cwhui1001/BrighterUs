<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Career Match') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12">
       

            <style>
        .quiz-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 80%;
            margin: 0 auto;
            
        }
        .question {
            line-height: 50px;
        }
        
        .btn-navigation {
            background-color:rgb(113, 59, 35); /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-navigation:hover {
            background-color:rgb(197, 101, 60); 
        }

        .btn-submit {
            background-color:rgb(217, 159, 0);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color:rgb(217, 159, 0);
        }

        .btn-restart {
            background-color:rgb(148, 0, 0); /* Gray */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-restart:hover {
            background-color: #9ca3af; /* Lighter Gray */
        }
        

    </style>
<div class="quiz-container">
<h3 class="text-lg font-bold mb-4">{{ __("Discover Your Ideal Career") }}</h3>
                <p>{{ __("Answer the questions below to find a career path that fits your personality.") }}</p>
                <div id="quiz">
                    <!-- Questions will be displayed one at a time -->
                    <form id="quiz-form">
                        <div id="question-1" class="question mb-6">
                            <p class="font-semibold">1. When you’re in a group, do you…</p>
                            <label>
                                <input type="radio" name="q1" value="E"> Prefer to lead conversations
                            </label><br>
                            <label>
                                <input type="radio" name="q1" value="I"> Prefer to listen and observe
                            </label>
                        </div>

                        <div id="question-2" class="question mb-6 hidden">
                            <p class="font-semibold">2. When solving problems, do you rely more on…</p>
                            <label>
                                <input type="radio" name="q2" value="S"> Facts and evidence
                            </label><br>
                            <label>
                                <input type="radio" name="q2" value="N"> Intuition and gut feelings
                            </label>
                        </div>

                        <div id="question-3" class="question mb-6 hidden">
                            <p class="font-semibold">3. Do you prefer decisions to be…</p>
                            <label>
                                <input type="radio" name="q3" value="T"> Logical and objective
                            </label><br>
                            <label>
                                <input type="radio" name="q3" value="F"> Compassionate and personal
                            </label>
                        </div>

                        <div id="question-4" class="question mb-6 hidden">
                            <p class="font-semibold">4. Do you plan your day…</p>
                            <label>
                                <input type="radio" name="q4" value="J"> In advance with a schedule
                            </label><br>
                            <label>
                                <input type="radio" name="q4" value="P"> Flexibly, adjusting as needed
                            </label>
                        </div>

                        <div id="question-5" class="question mb-6 hidden">
                            <p class="font-semibold">5. When meeting new people, do you…</p>
                            <label>
                                <input type="radio" name="q5" value="E"> Feel energized and excited
                            </label><br>
                            <label>
                                <input type="radio" name="q5" value="I"> Feel drained and reserved
                            </label>
                        </div>

                        <div id="question-6" class="question mb-6 hidden">
                            <p class="font-semibold">6. Do you focus on…</p>
                            <label>
                                <input type="radio" name="q6" value="S"> What is happening in the moment
                            </label><br>
                            <label>
                                <input type="radio" name="q6" value="N"> Possibilities and future ideas
                            </label>
                        </div>

                        <div id="question-7" class="question mb-6 hidden">
                            <p class="font-semibold">7. When making decisions, do you value…</p>
                            <label>
                                <input type="radio" name="q7" value="T"> Efficiency and consistency
                            </label><br>
                            <label>
                                <input type="radio" name="q7" value="F"> Empathy and harmony
                            </label>
                        </div>

                        <div id="question-8" class="question mb-6 hidden">
                            <p class="font-semibold">8. Do you feel more comfortable with…</p>
                            <label>
                                <input type="radio" name="q8" value="J"> Structure and routine
                            </label><br>
                            <label>
                                <input type="radio" name="q8" value="P"> Flexibility and spontaneity
                            </label>
                        </div>

                        <div id="question-9" class="question mb-6 hidden">
                            <p class="font-semibold">9. At a party, do you…</p>
                            <label>
                                <input type="radio" name="q9" value="E"> Enjoy being at the center
                            </label><br>
                            <label>
                                <input type="radio" name="q9" value="I"> Prefer one-on-one conversations
                            </label>
                        </div>

                        <div id="question-10" class="question mb-6 hidden">
                            <p class="font-semibold">10. Do you process information better through…</p>
                            <label>
                                <input type="radio" name="q10" value="S"> Details and step-by-step logic
                            </label><br>
                            <label>
                                <input type="radio" name="q10" value="N"> Big-picture thinking
                            </label>
                        </div>

                        <div id="question-11" class="question mb-6 hidden">
                            <p class="font-semibold">11. When arguing, do you prioritize…</p>
                            <label>
                                <input type="radio" name="q11" value="T"> Being right
                            </label><br>
                            <label>
                                <input type="radio" name="q11" value="F"> Maintaining relationships
                            </label>
                        </div>

                        <div id="question-12" class="question mb-6 hidden">
                            <p class="font-semibold">12. In a work environment, do you prefer…</p>
                            <label>
                                <input type="radio" name="q12" value="J"> Clear plans and deadlines
                            </label><br>
                            <label>
                                <input type="radio" name="q12" value="P"> Open-ended projects
                            </label>
                        </div>

                        <div id="question-13" class="question mb-6 hidden">
                            <p class="font-semibold">13. When thinking about a problem, do you focus on…</p>
                            <label>
                                <input type="radio" name="q13" value="S"> Practical solutions
                            </label><br>
                            <label>
                                <input type="radio" name="q13" value="N"> Creative and abstract ideas
                            </label>
                        </div>

                        <div id="question-14" class="question mb-6 hidden">
                            <p class="font-semibold">14. How do you recharge after a long day?</p>
                            <label>
                                <input type="radio" name="q14" value="E"> By spending time with friends
                            </label><br>
                            <label>
                                <input type="radio" name="q14" value="I"> By enjoying time alone
                        </div>

                        <div id="question-15" class="question mb-6 hidden">
                            <p class="font-semibold">15. When working on a project, do you…</p>
                            <label>
                                <input type="radio" name="q15" value="J"> Follow a structured timeline
                            </label><br>
                            <label>
                                <input type="radio" name="q15" value="P"> Work in bursts of inspiration
                            </label>
                        </div>


                        <!-- Navigation Buttons -->
                        <div class="mt-4">
                            <button type="button" id="prev-btn" onclick="navigateQuestion('prev')" class="btn-navigation">
                                Previous
                            </button>
                            <button type="button" id="next-btn" onclick="navigateQuestion('next')" class="btn-navigation">
                                Next
                            </button>
                            <button type="button" id="submit-btn" onclick="calculateResult()" class="btn-submit hidden">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Result section -->
                <div id="result" class="hidden mt-6">
                    <h4 class="text-lg font-bold">Your Personality Type: <span id="personality-type"></span></h4>
                    <h5 class="font-semibold mt-4">Recommended Career Paths:</h5>
                    <ul id="career-list" class="list-disc ml-4"></ul>
                    <button onclick="restartQuiz()" class="btn-restart">Restart Quiz</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        let currentQuestion = 1; // Track the current question
        const totalQuestions = 15; // Update to the total number of questions

        function navigateQuestion(direction) {
            // Hide the current question
            document.getElementById(`question-${currentQuestion}`).classList.add('hidden');

            // Update the current question based on the direction (next/prev)
            if (direction === 'next') {
                currentQuestion++;
            } else if (direction === 'prev') {
                currentQuestion--;
            }

            // Show the new question
            document.getElementById(`question-${currentQuestion}`).classList.remove('hidden');

            // Show or hide previous and next buttons
            if (currentQuestion === 1) {
                document.getElementById('prev-btn').classList.add('hidden');
            } else {
                document.getElementById('prev-btn').classList.remove('hidden');
            }

            if (currentQuestion === 15) {
                document.getElementById('next-btn').classList.add('hidden');
                document.getElementById('submit-btn').classList.remove('hidden');
            } else {
                document.getElementById('next-btn').classList.remove('hidden');
                document.getElementById('submit-btn').classList.add('hidden');
            }
        }

        function calculateResult() {
            const answers = {};
            document.querySelectorAll('#quiz-form .question').forEach((question, index) => {
                const selected = question.querySelector('input[type="radio"]:checked');
                if (selected) {
                    answers[`q${index + 1}`] = selected.value;
                }
            });

            // Ensure all questions are answered
            if (Object.keys(answers).length < 15) {
                alert('Please answer all questions.');
                return;
            }

            // Initialize counters for each MBTI category
            const mbtiCounts = {
                E: 0, // Extroversion
                I: 0, // Introversion
                S: 0, // Sensing
                N: 0, // Intuition
                T: 0, // Thinking
                F: 0, // Feeling
                J: 0, // Judging
                P: 0, // Perceiving
            };

            // Map questions to corresponding MBTI categories
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
                q13: ['S', 'N'],
                q14: ['E', 'I'],
                q15: ['J', 'P'],
            };

            // Count the answers for each MBTI category
            for (let [question, selectedOption] of Object.entries(answers)) {
                const [optionA, optionB] = mbtiMapping[question];
                if (selectedOption === optionA) {
                    mbtiCounts[optionA]++;
                } else if (selectedOption === optionB) {
                    mbtiCounts[optionB]++;
                }
            }

            // Determine MBTI type based on the highest counts in each pair
            const mbtiType =
                (mbtiCounts.E > mbtiCounts.I ? 'E' : 'I') +
                (mbtiCounts.S > mbtiCounts.N ? 'S' : 'N') +
                (mbtiCounts.T > mbtiCounts.F ? 'T' : 'F') +
                (mbtiCounts.J > mbtiCounts.P ? 'J' : 'P');

            // Map MBTI to career paths
            const careerMap = {
                "ESTJ": ["Insurance Sales Agent", "Pharmacist", "Lawyer", "Project Manager", "Judge"],
                "ISTJ": ["Auditor", "Accountant", "Chief Financial Officer", "Web Development Engineer", "Government Employee"],
                "ESFJ": ["Sales Representative", "Nurse/Healthcare Worker", "Social Worker", "PR Account Executive", "Loan Officer"],
                "ISFJ": ["Dentist", "Elementary School Teacher", "Librarian", "Franchise Owner", "Customer Service Representative"],
                "ESTP": ["Detective", "Banker", "Investor", "Entertainment Agent", "Sports Coach"],
                "ISTP": ["Civil Engineer", "Economist", "Pilot", "Data Communications Analyst", "Emergency Room Physician"],
                "ESFP": ["Child Welfare Counselor", "Primary Care Physician", "Actor", "Interior Designer", "Environmental Scientist"],
                "ISFP": ["Photographer", "Jewelry Designer", "Animal Care Specialist", "Fashion Designer", "Massage Therapist"],
                "ENTJ": ["Executive", "Lawyer", "Market Research Analyst", "Management/Business Consultant", "Venture Capitalist"],
                "INTJ": ["Investment Banker", "Personal Financial Adviser", "Software Developer", "Economist", "Executive"],
                "ENFJ": ["Advertising Executive", "Public Relations Specialist", "Corporate Coach/Trainer", "Sales Manager", "Employment Specialist/HR Professional"],
                "INFJ": ["Therapist/Mental Health Counselor", "Social Worker", "HR Diversity Manager", "Organizational Development Consultant", "Customer Relations Manager"],
                "ENTP": ["Entrepreneur", "Real Estate Developer", "Advertising Creative Director", "Marketing Director", "Politician/Political Consultant"],
                "INTP": ["Computer Programmer/Software Designer", "Financial Analyst", "Architect", "College Professor", "Economist"],
                "ENFP": ["Journalist", "Advertising Creative Director", "Consultant", "Restaurateur", "Event Planner"],
                "INFP": ["Graphic Designer", "Psychologist/Therapist", "Writer/Editor", "Physical Therapist", "HR Development Trainer"]
            };

            // Display the result
            document.getElementById('personality-type').innerText = mbtiType;
            const careerList = document.getElementById('career-list');
            careerList.innerHTML = '';
            (careerMap[mbtiType] || ["No matching careers found."]).forEach(career => {
                const li = document.createElement('li');
                li.textContent = career;
                careerList.appendChild(li);
            });

            // Show the result section
            document.getElementById('quiz').classList.add('hidden');
            document.getElementById('result').classList.remove('hidden');
        }

        function restartQuiz() {
            // Reset quiz form and UI
            document.getElementById('quiz-form').reset();
            currentQuestion = 1;
            document.getElementById('quiz').classList.remove('hidden');
            document.getElementById('result').classList.add('hidden');
            navigateQuestion('next'); // Restart the quiz and show the first question
        }
    </script>
</x-app-layout>
