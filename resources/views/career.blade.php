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
        /* Title Styling */
        #instructions p {
            font-size: 30px;
            font-weight: bold;
            color:rgb(88, 16, 3);
            margin-bottom: 10px;
        }
          /* List Styling */
        #instructions ul {
            list-style-type: disc;
            padding-left: 50px;
            padding-bottom: 20px;
            color: #333;
            line-height: 1.6;
        }

        #instructions ul li {
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .question {
            line-height: 50px;
            font-size: 18px;
        }
        
        .btn-next {
            background-color:rgb(195, 75, 62); /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-next:hover {
            background-color:rgb(122, 63, 38); 
        }

        .btn-prev {
            color: rgb(195, 75, 62);
            padding: 10px 20px;
            border:solid 2px rgb(195, 75, 62);
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-prev:hover {
            border:solid 2px rgb(131, 51, 42);
        }

        .btn-submit {
            background-color:rgb(213, 75, 0);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color:rgb(195, 72, 1);
        }

        .btn-start {
            background-color:rgb(126, 5, 5);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-start:hover {
            background-color:rgb(129, 22, 3);
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

        #result h2 {
            font-size: 1.5rem;
            color:rgb(106, 45, 45);
            margin-bottom: 1rem;
        }

        #result h3 {
            font-size: 1.25rem;
            font-style: bold;
            color:rgb(178, 132, 26);
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }

        #result ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        #result ul li {
            margin-bottom: 0.5rem;
        }

        #result {
            padding: 1.5rem;
        }

        

        

    </style>
<div class="quiz-container">
<h3 class="text-lg font-bold mb-4">{{ __("Discover Your Ideal Career") }}</h3>
<div id="instructions">
        <p><b>INSTRUCTIONS</b></p>
        <ul>
            <li>There are no right answers to any of these questions.</li>
            <li>Answer the questions quickly, do not over-analyze them.</li>
            <li>Answer the questions as “the way you are”, not “the way you’d like to be seen by others”.</li>
        </ul>
    </div>
<button id="start-btn" onclick="startQuiz()" class="btn-start" style="margin-bottom: 20px;">
        Start Quiz
    </button>
<div id="progress-bar-container" class="hidden">
    <div id="progress-bar" style="width: 0%; height: 10px; background-color:rgb(160, 24, 0);"></div>
</div>
                <div id="quiz" class="hidden">

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

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <!-- Navigation Buttons -->
                        <div class="mt-4">
                            <button type="button" id="prev-btn" onclick="navigateQuestion('prev')" class="btn-prev">
                                Previous
                            </button>
                            <button type="button" id="next-btn" onclick="navigateQuestion('next')" class="btn-next">
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
                    <h2 class="font-semibold mt-4">Your Personality Type: <span id="personality-type"></span></h2>
                    <p id="personality-description" class="mt-2"></p>
                    <h2 class="font-semibold mt-4">Recommended Career Paths:</h2>
                    <ul id="career-list" class="list-disc ml-4"></ul>
                    <h3 class="font-semibold mt-6">Trait Distribution</h3>
                    <canvas id="mbti-chart" width="30" height="10"></canvas>
                    <p>&nbsp;</p>
                    <button onclick="restartQuiz()" class="btn-restart">Restart Quiz</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        function startQuiz() {
        document.getElementById('instructions').classList.add('hidden');
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

            const mbtiDetails = {
            "ENFJ": {
                    overview: [
                        "ENFJs are people-focused individuals who excel at understanding, supporting, and inspiring others. They are warm, charismatic, and driven by a desire to bring out the best in others while maintaining harmony and structure. Their primary focus is on external feelings and internal intuition, allowing them to connect deeply and creatively with others."
                    ],
                    generalCharacteristics: [
                        "Genuinely interested in people and their well-being.",
                        "Exceptional at creating harmony and resolving conflicts.",
                        "Highly organized and motivated by structure and goals.",
                        "Loyal, trustworthy, and committed in relationships.",
                        "Sensitive to criticism and often seek approval from others.",
                        "Creative, imaginative, and driven by possibilities."
                    ],
                    strengths: [
                        "Outstanding people skills; warm and empathetic.",
                        "Inspirational and motivational, bringing out the best in others.",
                        "Loyal and hardworking in relationships and responsibilities.",
                        "Strong communication and leadership abilities.",
                        "Creative problem-solvers with a focus on future possibilities."
                    ],
                    weaknesses: [
                        "Prone to neglecting their own needs in favor of others.",
                        "May become controlling or overly dependent on others' approval.",
                        "Struggles with conflict and criticism, often avoiding difficult conversations.",
                        "Tendency to worry excessively or feel guilt in challenging situations.",
                        "Can be overly sensitive to discord, sometimes suppressing their own beliefs to maintain harmony."
                    ],
                    careerSuggestions: [
                        "Advertising Executive", "Public Relations Specialist", "Corporate Coach/Trainer", "Sales Manager", "Employment Specialist/HR Professional"
                    ]
                // Add other MBTI types here following the same structure
            },
            "ENTJ": {
                    overview: [
                        "ENTJs are natural-born leaders, driven to organize and lead others toward accomplishing goals. They are decisive, assertive, and excel at turning theories into actionable plans. Focused on efficiency and structure, ENTJs thrive in environments where they can lead and solve challenges, especially in their careers."
                    ],
                    generalCharacteristics: [
                        "Highly value knowledge and long-range thinking.",
                        "Decisive, assertive, and confident in decision-making.",
                        "Future-oriented, driven to accomplish ambitious goals.",
                        "Natural leaders with excellent communication skills.",
                        "Impatient with inefficiency and routine tasks.",
                        "Enjoys structured environments and high standards."
                    ],
                    strengths: [
                        "Excellent at translating ideas into actionable strategies.",
                        "Strong verbal communication and leadership abilities.",
                        "Fair-minded, enthusiastic, and encouraging of growth.",
                        "Skilled at turning conflicts into opportunities for growth.",
                        "Highly self-confident and decisive in problem-solving.",
                        "Effective at inspiring others and maintaining focus on goals."
                    ],
                    weaknesses: [
                        "May appear argumentative or confrontational during debates.",
                        "Tendency to dominate conversations and decision-making.",
                        "Not naturally attuned to others' feelings or emotions.",
                        "Can be critical of differing opinions or inefficiency.",
                        "Struggles with expressing affection or vulnerability.",
                        "Tendency to become overly controlling or dictatorial under stress.",
                        "May make hasty decisions or have difficulty listening to others' input."
                    ],
                    careerSuggestions: [
                        "Executive", "Lawyer", "Market Research Analyst", "Management/Business Consultant", "Venture Capitalist"
                    ]
                },
                "ENFP": {
                    overview: [
                        "ENFPs are warm, enthusiastic, and creative individuals who thrive on possibilities and are driven by their strong value systems. They inspire and motivate others through their energy and passion, excelling in environments where they can work with people and ideas flexibly. ENFPs seek meaning and fulfillment in all they do, valuing independence and authenticity."                    ],
                    generalCharacteristics: [
                        "Highly intuitive and perceptive about people and situations.",
                        "Warm, energetic, and future-oriented.",
                        "Project-driven and creative, with a broad range of talents.",
                        "Strongly value personal authenticity and meaningful connections.",
                        "Struggle with routine tasks and dislike being controlled.",
                        "Enjoy exploring new possibilities and experiences."
                    ],
                    strengths: [
                        "Excellent communication and interpersonal skills.",
                        "Highly motivational and inspirational, bringing out the best in others.",
                        "Warmly affectionate, fun, and optimistic.",
                        "Driven to meet others' needs and create win-win situations.",
                        "Creative problem-solvers who grasp complex ideas quickly."
                    ],
                    weaknesses: [
                        "May avoid mundane tasks and practical responsibilities.",
                        "Dislike conflict and criticism, sometimes excessively.",
                        "Can become bored or restless in stable, unchanging situations.",
                        "Tendency to hold onto bad relationships or pursue idealized ones.",
                        "May struggle to follow through on projects or commitments."
                    ],
                    careerSuggestions: [
                        "Journalist", "Advertising Creative Director", "Consultant", "Restaurateur", "Event Planner"
                    ]
                },
                
                "ENTP": {
                    overview: [
                        "ENTPs are energetic and inventive individuals who thrive on generating ideas and exploring possibilities. With a strong drive for understanding the world, they combine their intuition with logical thinking to solve complex problems creatively. They excel in dynamic environments, where their enthusiasm, flexibility, and curiosity shine."                     ],
                    generalCharacteristics: [
                        "Highly intuitive and quick to understand situations.",
                        "Creative, resourceful, and visionary thinkers.",
                        "Enjoy debating and exploring new ideas.",
                        "Adaptable, flexible, and able to motivate others.",
                        "Dislike routine, confining schedules, and mundane tasks.",
                        "Value knowledge and theoretical understanding."
                    ],
                    strengths: [
                        "Excellent communication and interpersonal skills.",
                        "Visionary and enthusiastic, able to inspire others.",
                        "Logical and rational problem-solvers.",
                        "Quick to grasp and work through complex concepts.",
                        "Laid-back, flexible, and open to change."
                    ],
                    weaknesses: [
                        "May struggle with following through on plans and ideas.",
                        "Dislike routine tasks and detailed work.",
                        "Love of debate can sometimes provoke arguments.",
                        "Big risk-takers, which may lead to financial mismanagement.",
                        "Tendency to abandon relationships lacking growth opportunities."
                    ],
                    careerSuggestions: [
                        "Entrepreneur", "Real Estate Developer", "Advertising Creative Director", "Marketing Director", "Politician/Political Consultant"
                    ]
                },
                "ESFJ": {
                    overview: [
                        "ESFJs are warm-hearted, organized, and people-focused individuals who value security, stability, and harmony. They take their responsibilities seriously and are dedicated to caring for others. They thrive in structured environments and are excellent at creating order and supporting those around them."
                    ],
                    generalCharacteristics: [
                        "Highly people-oriented, warm, and empathetic.",
                        "Excellent at reading others' needs and making them feel good.",
                        "Enjoys creating order, structure, and schedules.",
                        "Dependable, loyal, and value stability.",
                        "Sensitive to others' feelings, often self-sacrificing.",
                        "Practical, down-to-earth, and focused on the present."
                    ],
                    strengths: [
                        "Great at fulfilling duties and obligations.",
                        "Friendly, affirming, and service-oriented.",
                        "Responsible and practical, excellent with day-to-day tasks.",
                        "Commitment-focused, value lifelong relationships.",
                        "Traditionally-minded, family-oriented, and good with celebrations."
                    ],
                    weaknesses: [
                        "Dislike change and discomfort with new territory.",
                        "Sensitive to criticism and conflict, may seek approval.",
                        "May focus too much on others' needs, neglecting their own.",
                        "Tend to manipulate with guilt to fulfill desires.",
                        "Difficulty accepting the end of relationships, often taking the blame."
                    ],
                    careerSuggestions: [
                        "Sales Representative", "Nurse/Healthcare Worker", "Social Worker", "PR Account Executive", "Loan Officer"
                    ]
                },
                "ESFP": {
                    overview: [
                        "ESFPs are energetic, fun-loving, and people-oriented individuals who thrive on new experiences. They enjoy being the center of attention and are great at entertaining others. They are spontaneous and live in the present moment, valuing excitement and drama in their lives."                    ],
                    generalCharacteristics: [
                        "Lively and enthusiastic, enjoy new experiences.",
                        "Excellent people skills, warm and generous.",
                        "Practical, resourceful, and adaptable.",
                        "Spontaneous and dislike routine or structure.",
                        "Enjoy sensory experiences and aesthetic beauty.",
                        "Strong connection with animals and children."
                    ],
                    strengths: [
                        "Fun-loving and make everything enjoyable.",
                        "Clever, witty, and popular, they attract others.",
                        "Practical and creative, good at handling day-to-day needs.",
                        "Artistic and often have beautiful homes.",
                        "Flexible, adaptable, and can handle change well.",
                        "Generous and warm-hearted, make the most of every moment."
                    ],
                    weaknesses: [
                        "May take risks with money, materialistic tendencies.",
                        "Extreme dislike of criticism, takes things personally.",
                        "Tend to avoid conflict and may escape problems.",
                        "Struggle with long-term commitments, live day by day.",
                        "Neglect their own needs, sometimes abuse their bodies.",
                        "May frequently change partners, always seeking something new."
                    ],
                    careerSuggestions: [
                        "Child Welfare Counselor", "Primary Care Physician", "Actor", "Interior Designer", "Environmental Scientist"
                    ]
                },
                "ESTJ": {
                    overview: [
                        "ESTJs are organized, efficient, and practical individuals who value tradition, order, and security. They naturally take on leadership roles, are decisive, and focus on achieving tangible results. They are direct, logical, and tend to have high standards for themselves and others."
                    ],
                    generalCharacteristics: [
                        "Natural leaders, enjoy being in charge.",
                        "Value security, tradition, and loyalty.",
                        "Hard-working, dependable, and organized.",
                        "Clear set of standards and beliefs.",
                        "Thorough, detail-oriented, and efficient.",
                        "Straightforward and honest in communication."
                    ],
                    strengths: [
                        "Enthusiastic, upbeat, and friendly.",
                        "Stable and dependable, promoting security in relationships.",
                        "Dedicated to fulfilling responsibilities and obligations.",
                        "Good at handling day-to-day practical concerns.",
                        "Conservative but reliable with finances.",
                        "Unthreatened by conflict and interested in resolution.",
                        "Take commitments seriously, seeking lifelong relationships.",
                        "Able to move on after breakups and administer discipline."
                    ],
                    weaknesses: [
                        "Tend to believe they are always right.",
                        "Need to be in control and may resist compromise.",
                        "Impatient with inefficiency and mistakes.",
                        "Struggle to express or understand emotions.",
                        "May unintentionally hurt others with insensitivity.",
                        "Materialistic and focused on status.",
                        "Uncomfortable with change and new experiences."
                    ],
                    careerSuggestions: [
                        "Insurance Sales Agent", "Pharmacist", "Lawyer", "Project Manager", "Judge"
                    ]
                },
                "ESTP": {
                    overview: [
                        "ESTPs are energetic, action-oriented individuals who thrive in the present moment. They prefer to take direct action, focusing on facts and practical solutions rather than abstract theories. Quick decision-makers and enthusiastic, they enjoy taking risks and living life to the fullest."                    ],
                    generalCharacteristics: [
                        "Action-oriented and live in the moment.",
                        "Prefer practical solutions over theory.",
                        "Fast-paced, energetic, and adaptable.",
                        "Resourceful, observant, and have excellent people skills.",
                        "Highly observant with a great memory for details.",
                        "Prefer to make things up as they go rather than following a plan.",
                        "Attracted to adventure and risk."
                    ],
                    strengths: [
                        "Charming, witty, and popular.",
                        "Excellent at handling emergencies with a clear head.",
                        "Fun-loving and enthusiastic, making things enjoyable.",
                        "Eager to spend time with kids and engage in playful activities.",
                        "May lavish their loved ones with gifts."
                    ],
                    weaknesses: [
                        "Not in tune with others' feelings or good at expressing emotions.",
                        "Can be insensitive with language and actions.",
                        "Risky with money, may overindulge.",
                        "Live in the present and struggle with long-term planning.",
                        "Tend to ignore conflict rather than resolving it.",
                        "Don't naturally make lifelong commitments and may leave relationships quickly when bored."
                    ],
                    careerSuggestions: [
                        "Dentist", "Elementary School Teacher", "Librarian", "Franchise Owner", "Customer Service Representative"
                    ]
                },
                "INFJ": {
                    overview: [
                        "INFJs are gentle, caring, and deeply intuitive individuals with a strong desire for meaningful relationships and personal growth. They are idealistic and strive for harmony, often focusing on the bigger picture. They are rare, complex, and have a profound ability to understand people and situations intuitively."
                    ],
                    generalCharacteristics: [
                        "Highly intuitive and idealistic.",
                        "Deeply principled and values authenticity.",
                        "Natural leaders with a strong vision.",
                        "Compassionate, sensitive to others' feelings.",
                        "Reserved and private about their true selves.",
                        "Creative, visionary, and future-oriented.",
                        "Focus on meaning and purpose in all aspects of life.",
                        "Tend to avoid or get overwhelmed by minutiae.",
                        "Perfectionists, with high expectations of themselves and others."
                    ],
                    strengths: [
                        "Warm and affirming, dedicated to meaningful relationships.",
                        "Sensitive and concerned for others' feelings.",
                        "Good communication skills, especially in writing.",
                        "Take commitments seriously, seeking lifelong relationships.",
                        "Excellent listeners and empathetic.",
                        "Able to move on from a relationship once sure it's over."
                    ],
                    weaknesses: [
                        "Tendency to hold back part of themselves.",
                        "Struggles with practical day-to-day tasks and finances.",
                        "Extreme dislike of conflict and criticism.",
                        "High expectations can be both a strength and a weakness.",
                        "Difficulty leaving a bad relationship."
                    ],
                    careerSuggestions: [
                        "Therapist/Mental Health Counselor", "Social Worker", "HR Diversity Manager", "Organizational Development Consultant", "Customer Relations Manager"
                    ]
                },
                "INFP": {
                    overview: [
                        "INFPs are idealistic, perfectionistic individuals who seek meaning and purpose in life, aiming to make the world a better place. They are deeply intuitive about people, driven by their values, and dedicated to helping others. They are creative, compassionate, and value deep relationships."                    
                    ],
                    generalCharacteristics: [
                        "Strong value systems and a drive to make the world better.",
                        "Sensitive, deeply caring, and empathetic.",
                        "Flexible and laid-back until their values are violated.",
                        "Creative, inspirational, and future-oriented.",
                        "Prefer to work alone and dislike routine work.",
                        "Seek personal growth and value meaningful experiences.",
                        "Excellent at expressing themselves in writing.",
                        "Avoid conflict and prefer win-win situations."
                    ],
                    strengths: [
                        "Warm, loyal, and committed to lifelong relationships.",
                        "Deep capacity for love and care.",
                        "Sensitive and perceptive about others' feelings.",
                        "Nurturing, supportive, and encouraging.",
                        "Able to express themselves well and understand others.",
                        "Flexible and able to adapt to diverse situations."
                    ],
                    weaknesses: [
                        "May be shy, reserved, and dislike having their space invaded.",
                        "Extreme dislike of conflict and criticism.",
                        "Strong need for praise and positive affirmation.",
                        "May react emotionally in stressful situations.",
                        "Have difficulty leaving a bad relationship or punishing others.",
                        "Tend to hold everything on their shoulders and blame themselves."
                    ],
                    careerSuggestions: [
                        "Graphic Designer", "Psychologist/Therapist", "Writer/Editor", "Physical Therapist", "HR Development Trainer"
                    ]
                },
                "INTJ": {
                    overview: [
                        "INTJs are strategic, logical, and future-oriented thinkers who excel at generating ideas, solving complex problems, and organizing systems. They are highly independent and value intelligence, knowledge, and efficiency. They are natural leaders with a drive to create lasting and meaningful structures."                    ],
                    generalCharacteristics: [
                        "Driven to create order from complexity and abstractions.",
                        "Strategic thinkers with a focus on the big picture.",
                        "Self-reliant and prefer to work alone.",
                        "Value knowledge, logic, and efficiency.",
                        "Calm, collected, and analytical.",
                        "Highly intelligent with strong insights and intuitions.",
                        "Bored by routine and inefficiency.",
                        "Highly ambitious, self-confident, and capable of achieving their goals.",
                        "Creative, ingenious, and innovative."
                    ],
                    strengths: [
                        "Self-confident and capable.",
                        "Take relationships seriously and are good listeners.",
                        "Able to handle conflict without being threatened.",
                        "Efficient and strive for optimization in relationships.",
                        "Extremely intelligent and generally competent."
                    ],
                    weaknesses: [
                        "May be insensitive to others' feelings and emotions.",
                        "Tend to respond to conflict with logic, rather than emotional support.",
                        "Struggle to express affections and feelings.",
                        "Believes they are always right and may be unwilling to accept blame.",
                        "Constantly seeking to improve, which can be taxing on relationships.",
                        "Tend to hold back parts of themselves."
                    ],
                    careerSuggestions: [
                        "Investment Banker", "Personal Financial Adviser", "Software Developer", "Economist", "Executive"
                    ]
                },
                "INTP": {
                    overview: [
                        "INTPs are deep thinkers focused on abstract ideas, theories, and concepts. They value knowledge and logic, constantly seeking to understand and solve complex problems. Independent and original, they excel at analyzing and forming new ideas but can be distant and uninterested in practical tasks or emotional considerations."                    
                    ],
                    generalCharacteristics: [
                        "Driven by abstract ideas and theories.",
                        "Highly value knowledge, competence, and independent thinking.",
                        "Work best alone and value autonomy.",
                        "Dislike mundane details and practical applications.",
                        "Creative, insightful, and capable of generating innovative solutions.",
                        "Tend to live inside their own minds, appearing detached from others.",
                        "Not interested in traditional goals such as popularity or security.",
                        "Tend to focus on the big picture and future-oriented thinking."
                    ],
                    strengths: [
                        "Highly imaginative, creative, and enthusiastic about ideas.",
                        "Not personally threatened by conflict or criticism.",
                        "Laid-back and easy-going in relationships.",
                        "Pure and childlike affection for loved ones.",
                        "Tend to approach problems and interests with enthusiasm."
                    ],
                    weaknesses: [
                        "Slow to respond to emotional needs and struggles with emotional expression.",
                        "Not good at handling practical matters like money management.",
                        "Tend to distrust others and have difficulty leaving bad relationships.",
                        "Avoid conflict or blow up in anger when confronted.",
                        "Not naturally in tune with others' feelings or needs."
                    ],
                    careerSuggestions: [
                        "Computer Programmer/Software Designer", "Financial Analyst", "Architect", "College Professor", "Economist"
                    ]
                },
                "ISFJ": {
                    overview: [
                        "ISFJs are warm, dependable, and service-oriented individuals who focus on practical, concrete details. They are deeply attuned to the needs and emotions of others and have a strong sense of responsibility. They value tradition, security, and harmony, and tend to avoid conflict while striving to fulfill their obligations."                    ],
                    generalCharacteristics: [
                        "Strong memory for important details and people.",
                        "Highly observant and sensitive to others' feelings.",
                        "Value security, stability, and tradition.",
                        "Work best with hands-on learning and practical tasks.",
                        "Prefer structured environments and dislike abstract thinking.",
                        "Service-oriented, focused on helping others and meeting their needs.",
                        "Have an exceptional ability to create order and maintain stability."
                    ],
                    strengths: [
                        "Warm, friendly, and generous.",
                        "Excellent at fulfilling obligations and responsibilities.",
                        "Good listeners and attentive to others' needs.",
                        "Strong organizational skills and practical capabilities.",
                        "Excellent at taking care of daily needs and handling money.",
                        "Take their commitments seriously, seeking lifelong relationships."
                    ],
                    weaknesses: [
                        "Tend to neglect their own needs in favor of others.",
                        "Dislike conflict and criticism, leading to avoidance.",
                        "May have difficulty expressing their own emotions and frustrations.",
                        "Struggle to leave bad relationships or move on from them.",
                        "Find it difficult to branch out into new or unfamiliar territories."
                    ],
                    careerSuggestions: [
                        "Dentist", "Elementary School Teacher", "Librarian", "Franchise Owner", "Customer Service Representative"
                    ]
                },
                "ISFP": {
                    overview: [
                        "ISFPs are quiet, sensitive, and creative individuals who prioritize living according to their personal values. They are attuned to their senses and enjoy beauty and aesthetics. They are independent, action-oriented, and often have a strong desire to contribute to the well-being of others. While they value personal freedom, they are also deeply caring and service-oriented."
                    ],
                    generalCharacteristics: [
                        "Highly aware of their surroundings, focusing on sensory experiences.",
                        "Value aesthetics, beauty, and art, often with strong artistic talents.",
                        "Live in the present moment, with a strong desire to savor life.",
                        "Prefer hands-on learning and dislike abstract theory without practical application.",
                        "Strong value systems and a need to live according to personal beliefs.",
                        "Quiet and reserved, yet deeply caring and service-oriented.",
                        "Independently minded, with a dislike for control or leadership roles."
                    ],
                    strengths: [
                        "Warm, kind, and empathetic.",
                        "Service-oriented, motivated by helping others.",
                        "Good at handling practical, everyday concerns.",
                        "Enjoy expressing affection through actions rather than words.",
                        "Appreciate beauty and create aesthetically pleasing environments.",
                        "Committed to relationships and value lifelong connections."
                    ],
                    weaknesses: [
                        "Dislike long-term planning or structured routines.",
                        "Sensitive to conflict and criticism, may avoid it.",
                        "May appear lazy or slow-moving at times, focused on the present.",
                        "Need personal space, and may feel uncomfortable when it’s invaded.",
                        "Reluctant to express feelings and thoughts unless prompted.",
                        "Tend to be overly practical and may become cynical at times."
                    ],
                    careerSuggestions: [
                        "Photographer", "Jewelry Designer", "Animal Care Specialist", "Fashion Designer", "Massage Therapist"
                    ]
                },
                "ISTJ": {
                    overview: [
                        "ISTJs are quiet, organized, and dependable individuals who value tradition, security, and fulfilling their duties. They are methodical and efficient, often working long hours to ensure that tasks are completed. They have a strong sense of responsibility and a deep respect for facts and concrete information. While serious and reserved, they are loyal, family-minded, and committed to their goals."                    ],
                    generalCharacteristics: [
                        "Highly organized and methodical, with a strong sense of duty.",
                        "Loyal, faithful, and dependable, with a deep respect for tradition.",
                        "Prefer concrete information and practical applications over abstract theory.",
                        "Natural leaders, but prefer to work alone or in structured teams.",
                        "Value stability and security in their lives and surroundings.",
                        "Dislike change unless the benefits are clear and concrete.",
                        "High standards for themselves and others, with a focus on fulfilling commitments."
                    ],
                    strengths: [
                        "Honors commitments and responsibilities.",
                        "Good at managing money and practical concerns.",
                        "Can communicate clearly and precisely.",
                        "Strong at listening and taking constructive criticism.",
                        "Tolerant of conflict situations without emotional disruption.",
                        "Effective in leadership roles and delivering necessary criticism."
                    ],
                    weaknesses: [
                        "Tendency to believe they are always right.",
                        "May get involved in 'win-lose' conversations.",
                        "Not naturally attuned to others' emotions.",
                        "Value for structure may seem rigid to others.",
                        "May not give enough praise or affirmation to loved ones."
                    ],
                    careerSuggestions: [
                        "Auditor", "Accountant", "Chief Financial Officer", "Web Development Engineer", "Government Employee"
                    ]
                },
                "ISTP": {
                    overview: [
                        "ISTPs are action-oriented, independent, and logical individuals with a deep interest in how things work. They excel at hands-on tasks and are highly practical, often thriving in crisis situations. They prefer immediate results and have a strong drive for new experiences and variety. While they value independence and freedom, they are loyal and fair-minded, with a natural ability to solve practical problems."
                    ],
                    generalCharacteristics: [
                        "Focused on understanding how things work through logical analysis.",
                        "Action-oriented and thrive on hands-on experiences.",
                        "Highly independent and dislike structured or regimented environments.",
                        "Practical, realistic, and results-driven with a preference for solving problems immediately.",
                        "Dislike abstract theory unless it has a clear practical application.",
                        "Natural troubleshooters with excellent technical skills."
                    ],
                    strengths: [
                        "Good listeners and generally optimistic.",
                        "Practical and handle daily concerns effectively.",
                        "Not intimidated by conflict or criticism.",
                        "Respect others' need for space and privacy.",
                        "Able to handle and resolve crises efficiently."
                    ],
                    weaknesses: [
                        "Difficulty with long-term commitments, living in the present.",
                        "Not naturally attuned to expressing or understanding emotions.",
                        "Tendency to be overly private and keep part of themselves hidden.",
                        "Need a lot of personal space and dislike being confined.",
                        "May stir up excitement or conflict due to a craving for action."
                    ],
                    careerSuggestions: [
                        "Civil Engineer", "Economist", "Pilot", "Data Communications Analyst", "Emergency Room Physician"
                    ]
                },
        };
    

            const details = mbtiDetails[mbtiType];
            if (!details) {
                alert("MBTI type not found."); // Add graceful error handling
                return;
            }


            document.getElementById('personality-type').textContent = mbtiType;
            // Add sections dynamically
                const descriptionContainer = document.getElementById("personality-description");
                descriptionContainer.innerHTML = `
                    <h3>Overview</h3>
                    <ul>${details.overview.map(item => `<li>${item}</li>`).join('')}</ul>
                    <h3>General Characteristics</h3>
                    <ul>${details.generalCharacteristics.map(item => `<li>${item}</li>`).join('')}</ul>
                    <h3>Strengths</h3>
                    <ul>${details.strengths.map(item => `<li>${item}</li>`).join('')}</ul>
                    <h3>Potential Weaknesses</h3>
                    <ul>${details.weaknesses.map(item => `<li>${item}</li>`).join('')}</ul>
                `;

                // Add career suggestions
                const careerList = document.getElementById("career-list");
                careerList.innerHTML = details.careerSuggestions.map(career => `<li>${career}</li>`).join('');

                document.getElementById("quiz").classList.add("hidden");
                document.getElementById("result").classList.remove("hidden");

            // Generate the graph with scores for all 8 traits
            const ctx = document.getElementById('mbti-chart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['E', 'I', 'S', 'N', 'T', 'F', 'J', 'P'],
                    datasets: [{
                        label: 'Trait Scores',
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
