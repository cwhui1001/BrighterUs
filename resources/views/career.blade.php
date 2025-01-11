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
            max-width: 60%;
            margin: 0 auto;
            
        }
        .question {
            line-height: 50px;
            font-size: 18px;
        }
        
        .btn-navigation {
            background-color:rgb(195, 75, 62); /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-navigation:hover {
            background-color:rgb(122, 63, 38); 
        }

        .btn-submit {
            background-color:rgb(139, 113, 44);
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
            background-color:rgb(98, 0, 0); /* Gray */
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
        #progress-bar-container {
            width: 100%;
            background-color: #e0e0e0; /* Light gray background */
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px; /* Space below the bar */
        }

        #progress-bar {
            height: 10px;
            background-color:rgb(255, 85, 0); /* Blue progress bar */
            width: 0%;
            transition: width 0.3s ease; /* Smooth transition */
        }
        

        

    </style>
<div class="quiz-container">
<h3 class="text-lg font-bold mb-4">{{ __("Discover Your Ideal Career") }}</h3>
<div id="progress-bar-container">
    <div id="progress-bar" style="width: 0%; height: 10px; background-color:rgb(160, 24, 0);"></div>
</div>
                <div id="quiz">

                    <!-- Questions will be displayed one at a time -->
                    <form id="quiz-form">
                        <div id="question-1" class="question mb-6">
                            <p class="font-semibold">1. When you’re in a group, do you…</p>
                            <label>
                                <input type="radio" name="q1" value="E" onchange="navigateQuestion('next')"> Prefer to lead conversations
                            </label><br>
                            <label>
                                <input type="radio" name="q1" value="I" onchange="navigateQuestion('next')"> Prefer to listen and observe
                            </label>
                        </div>

                        <div id="question-2" class="question mb-6 hidden">
                            <p class="font-semibold">2. When solving a problem, do you:</p>
                            <label>
                                <input type="radio" name="q2" value="S" onchange="navigateQuestion('next')"> Use practical methods based on past experiences?
                            </label><br>
                            <label>
                                <input type="radio" name="q2" value="N" onchange="navigateQuestion('next')"> Explore innovative or abstract solutions?
                            </label>
                        </div>

                        <div id="question-3" class="question mb-6 hidden">
                            <p class="font-semibold">3. When resolving a conflict, do you:</p>
                            <label>
                                <input type="radio" name="q3" value="T" onchange="navigateQuestion('next')"> Focus on finding a fair, logical solution?
                            </label><br>
                            <label>
                                <input type="radio" name="q3" value="F" onchange="navigateQuestion('next')"> Prioritize maintaining harmony and emotional balance?
                            </label>
                        </div>

                        <div id="question-4" class="question mb-6 hidden">
                            <p class="font-semibold">4. On a weekend, do you:</p>
                            <label>
                                <input type="radio" name="q4" value="J" onchange="navigateQuestion('next')"> Prefer to have a planned schedule?
                            </label><br>
                            <label>
                                <input type="radio" name="q4" value="P" onchange="navigateQuestion('next')"> Go with the flow and decide spontaneously?
                            </label>
                        </div>

                        <div id="question-5" class="question mb-6 hidden">
                            <p class="font-semibold">5. When meeting new people, do you…</p>
                            <label>
                                <input type="radio" name="q5" value="E" onchange="navigateQuestion('next')"> Feel energized and excited
                            </label><br>
                            <label>
                                <input type="radio" name="q5" value="I" onchange="navigateQuestion('next')"> Feel drained and reserved
                            </label>
                        </div>

                        <div id="question-6" class="question mb-6 hidden">
                            <p class="font-semibold">6. In your daily activities, do you:</p>
                            <label>
                                <input type="radio" name="q6" value="S" onchange="navigateQuestion('next')"> Focus on what needs to be done right now?
                            </label><br>
                            <label>
                                <input type="radio" name="q6" value="N" onchange="navigateQuestion('next')"> Think about future possibilities or implications?
                            </label>
                        </div>

                        <div id="question-7" class="question mb-6 hidden">
                            <p class="font-semibold">7. If a friend asks for advice, do you:</p>
                            <label>
                                <input type="radio" name="q7" value="T" onchange="navigateQuestion('next')"> Offer a logical solution to their problem?
                            </label><br>
                            <label>
                                <input type="radio" name="q7" value="F" onchange="navigateQuestion('next')"> Provide emotional support and encouragement?
                            </label>
                        </div>

                        <div id="question-8" class="question mb-6 hidden">
                            <p class="font-semibold">8. Do you feel more comfortable with…</p>
                            <label>
                                <input type="radio" name="q8" value="J" onchange="navigateQuestion('next')"> Structure and routine
                            </label><br>
                            <label>
                                <input type="radio" name="q8" value="P" onchange="navigateQuestion('next')"> Flexibility and spontaneity
                            </label>
                        </div>

                        <div id="question-9" class="question mb-6 hidden">
                            <p class="font-semibold">9. At a party, are you more likely to:</p>
                            <label>
                                <input type="radio" name="q9" value="E" onchange="navigateQuestion('next')"> Mingle and meet as many people as possible
                            </label><br>
                            <label>
                                <input type="radio" name="q9" value="I" onchange="navigateQuestion('next')"> Stick with a smaller group of familiar faces
                            </label>
                        </div>

                        <div id="question-10" class="question mb-6 hidden">
                            <p class="font-semibold">10. When following directions, do you prefer:</p>
                            <label>
                                <input type="radio" name="q10" value="S" onchange="navigateQuestion('next')"> Clear, detailed, step-by-step instructions?
                            </label><br>
                            <label>
                                <input type="radio" name="q10" value="N" onchange="navigateQuestion('next')"> A general overview that allows for interpretation?
                            </label>
                        </div>

                        <div id="question-11" class="question mb-6 hidden">
                            <p class="font-semibold">11. In team settings, do you:</p>
                            <label>
                                <input type="radio" name="q11" value="T" onchange="navigateQuestion('next')"> Prioritize efficiency and meeting objectives?
                            </label><br>
                            <label>
                                <input type="radio" name="q11" value="F" onchange="navigateQuestion('next')"> Focus on creating a positive and inclusive atmosphere?
                            </label>
                        </div>

                        <div id="question-12" class="question mb-6 hidden">
                            <p class="font-semibold">12. In a group project, do you:</p>
                            <label>
                                <input type="radio" name="q12" value="J" onchange="navigateQuestion('next')"> Focus on setting goals and meeting deadlines?
                            </label><br>
                            <label>
                                <input type="radio" name="q12" value="P" onchange="navigateQuestion('next')"> Encourage flexibility and adapt to changing ideas?
                            </label>
                        </div>

                        <div id="question-13" class="question mb-6 hidden">
                            <p class="font-semibold">13. When in a new environment, do you:</p>
                            <label>
                                <input type="radio" name="q13" value="E" onchange="navigateQuestion('next')"> Introduce yourself to new people right away?
                            </label><br>
                            <label>
                                <input type="radio" name="q13" value="I" onchange="navigateQuestion('next')"> Wait and observe before making connections?
                            </label>
                        </div>

                        <div id="question-14" class="question mb-6 hidden">
                            <p class="font-semibold">14. When reading a book, do you enjoy:</p>
                            <label>
                                <input type="radio" name="q14" value="S" onchange="navigateQuestion('next')"> Realistic stories with relatable events?
                            </label><br>
                            <label>
                                <input type="radio" name="q14" value="N" onchange="navigateQuestion('next')"> Fantasy or stories with complex ideas and symbolism?
                            </label>
                        </div>

                        <div id="question-15" class="question mb-6 hidden">
                            <p class="font-semibold">15. Do you prefer decisions to be…</p>
                            <label>
                                <input type="radio" name="q15" value="T" onchange="navigateQuestion('next')"> Logical and objective
                            </label><br>
                            <label>
                                <input type="radio" name="q15" value="F" onchange="navigateQuestion('next')"> Compassionate and personal
                            </label>
                        </div>

                        <div id="question-16" class="question mb-6 hidden">
                            <p class="font-semibold">16. In your study space, do you:</p>
                            <label>
                                <input type="radio" name="q16" value="J" onchange="navigateQuestion('next')"> Keep things neat and organized?
                            </label><br>
                            <label>
                                <input type="radio" name="q16" value="P" onchange="navigateQuestion('next')"> Work in a space that’s creatively messy?
                            </label>
                        </div>
                        <div id="question-17" class="question mb-6 hidden">
                            <p class="font-semibold">17. In your free time, do you:</p>
                            <label>
                                <input type="radio" name="q17" value="E" onchange="navigateQuestion('next')"> Prefer spending time with friends or in group activities?
                            </label><br>
                            <label>
                                <input type="radio" name="q17" value="I" onchange="navigateQuestion('next')"> Prefer quiet time alone or with one close companion?
                            </label>
                        </div>

                        <div id="question-18" class="question mb-6 hidden">
                            <p class="font-semibold">18. When planning a trip, do you:</p>
                            <label>
                                <input type="radio" name="q18" value="S" onchange="navigateQuestion('next')"> Organize every detail in advance?
                            </label><br>
                            <label>
                                <input type="radio" name="q18" value="N" onchange="navigateQuestion('next')"> Focus on the big picture and stay flexible?
                            </label>
                        </div>

                        <div id="question-19" class="question mb-6 hidden">
                            <p class="font-semibold">19. When giving feedback, do you:</p>
                            <label>
                                <input type="radio" name="q19" value="T" onchange="navigateQuestion('next')"> Be honest and direct, even if it might upset someone?
                            <label><br>
                                <input type="radio" name="q19" value="F" onchange="navigateQuestion('next')"> Phrase it gently to avoid hurting feelings?
                            </label>
                        </div>

                        <div id="question-20" class="question mb-6 hidden">
                            <p class="font-semibold">20. When approaching deadlines, do you:</p>
                            <label>
                                <input type="radio" name="q20" value="J" onchange="navigateQuestion('next')"> Complete tasks well in advance?
                            <label><br>
                                <input type="radio" name="q20" value="P" onchange="navigateQuestion('next')"> Work best under last-minute pressure?
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
            document.getElementById('prev-btn').classList.toggle('hidden', currentQuestion === 1);
            document.getElementById('next-btn').classList.toggle('hidden', currentQuestion === totalQuestions);
            document.getElementById('submit-btn').classList.toggle('hidden', currentQuestion !== totalQuestions);

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

            const careerSuggestions = {
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

            document.getElementById('personality-type').textContent = mbtiType;
            const careerList = document.getElementById('career-list');
            careerList.innerHTML = careerSuggestions[mbtiType]?.map(career => `<li>${career}</li>`).join('') || 'No suggestions found.';

            document.getElementById('quiz').classList.add('hidden');
            document.getElementById('result').classList.remove('hidden');
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
    document.getElementById('prev-btn').style.display = 'inline-block';
    document.getElementById('next-btn').style.display = 'inline-block';
    document.getElementById('submit-btn').classList.add('hidden');

    // Reset progress bar
    document.getElementById('progress-bar').style.width = '0%';

    // Show quiz and hide result section
    document.getElementById('quiz').classList.remove('hidden');
    document.getElementById('result').classList.add('hidden');
}

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('prev-btn').classList.add('hidden');
            navigateQuestion();
        });
    </script>


</x-app-layout>
