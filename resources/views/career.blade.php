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
        .btn-download {
            background-color:rgb(255, 255, 255); /* Gray */
            color: grey;
            padding: 10px 20px;
            border: solid 2px rgb(76, 76, 76);
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align: right;
        }

        .btn-download:hover {
            background-color:rgb(216, 216, 216); /* Lighter Gray */
            color: white;
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
            margin-left: 50px;
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
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
                    
                    <canvas id="mbti-chart" width="30" height="10"></canvas>
                    <p>&nbsp;</p>
                    <button onclick="downloadPDF()" class="btn-download">Download PDF</button>
                    <button onclick="restartQuiz()" class="btn-restart">Restart Quiz</button>
                </div>
            </div>
        </div>
    </div>
</div>

        <?php
            $servername = "localhost";
            $username = "root"; // XAMPP 默认用户名
            $password = ""; // XAMPP 默认没有密码
            $dbname = "brighterus";

            // 创建连接
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 检查连接
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // 获取 ENFJ 数据
            $sql = "SELECT * FROM mbti_profiles WHERE type='ENFJ'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo json_encode($row);
            } else {
                echo json_encode(["error" => "No data found"]);
            }

            $conn->close();
        ?>

<script>
        fetch('fetch_mbti.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.log(data.error);
            } else {
                console.log("ENFJ Profile:", data);
            }
        })
        .catch(error => console.error("Error fetching data:", error));

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
                        "ESTJs are organized, decisive, and practical leaders who value tradition, order, and tangible results. They are logical, efficient, and set high standards for themselves and others."
                    ],
                    generalCharacteristics: [
                        "Natural leaders who value security and tradition.",
                        "Hard-working, dependable, and organized.",
                        "Straightforward and honest communicators.",
                        "Detail-oriented with clear standards and beliefs."
                    ],
                    strengths: [
                        "Enthusiastic, friendly, and dependable.",
                        "Efficient in handling responsibilities and practical concerns.",
                        "Resilient during conflicts, focused on resolution.",
                        "Take commitments seriously, promoting security in relationships."
                    ],
                    weaknesses: [
                        "May resist compromise and need control.",
                        "Impatient with inefficiency or mistakes.",
                        "Struggle with expressing emotions and handling change."
                    ],
                    careerSuggestions: [
                        "Insurance Sales Agent", "Pharmacist", "Lawyer", "Project Manager", "Judge"
                    ]
                },
                "ESTP": {
                    overview: [
                        "ESTPs are energetic, action-oriented individuals who thrive in the moment. They prefer practical solutions, quick decisions, and enjoy taking risks and exploring new experiences."
                    ],
                    generalCharacteristics: [
                        "Fast-paced, adaptable, and resourceful.",
                        "Prefer practical solutions over theory.",
                        "Highly observant and skilled in social interactions.",
                        "Attracted to adventure and living in the present."
                    ],
                    strengths: [
                        "Charming, witty, and fun-loving.",
                        "Handle emergencies with a clear head.",
                        "Bring enthusiasm and enjoyment to activities."
                    ],
                    weaknesses: [
                        "Insensitive to emotions and feelings.",
                        "Risky with finances and struggle with long-term planning.",
                        "May avoid conflict and lack commitment in relationships."
                    ],
                    careerSuggestions: [
                        "Dentist", "Elementary School Teacher", "Librarian", "Franchise Owner", "Customer Service Representative"
                    ]
                },
                "INFJ": {
                    overview: [
                        "INFJs are intuitive, caring, and idealistic individuals driven by meaningful connections and personal growth. They value harmony, authenticity, and have a unique ability to understand people deeply."
                    ],
                    generalCharacteristics: [
                        "Highly intuitive, principled, and future-focused.",
                        "Compassionate, sensitive, and private.",
                        "Creative visionaries seeking purpose and meaning.",
                        "Perfectionists with high expectations of themselves and others."
                    ],
                    strengths: [
                        "Empathetic, warm, and committed to deep relationships.",
                        "Excellent communicators, especially in writing.",
                        "Dedicated to personal and relational growth."
                    ],
                    weaknesses: [
                        "Dislike conflict and criticism.",
                        "Struggle with practical tasks and finances.",
                        "May have difficulty leaving unhealthy relationships."
                    ],
                    careerSuggestions: [
                        "Therapist", "Social Worker", "HR Diversity Manager", "Organizational Development Consultant", "Customer Relations Manager"
                    ]
                },
                "INFP": {
                    overview: [
                        "INFPs are idealistic and compassionate individuals seeking meaning and purpose in life. They are driven by personal values, creativity, and the desire to help others."
                    ],
                    generalCharacteristics: [
                        "Strong value systems with a desire to make the world better.",
                        "Sensitive, empathetic, and flexible.",
                        "Creative, inspirational, and focused on personal growth.",
                        "Avoid conflict and prefer harmonious solutions."
                    ],
                    strengths: [
                        "Loyal, caring, and nurturing in relationships.",
                        "Highly perceptive of others' feelings.",
                        "Adaptable and excellent at self-expression."
                    ],
                    weaknesses: [
                        "Dislike conflict and criticism.",
                        "May struggle with self-doubt and emotional stress.",
                        "Find it hard to leave unhealthy relationships."
                    ],
                    careerSuggestions: [
                        "Graphic Designer", "Psychologist", "Writer", "Physical Therapist", "HR Development Trainer"
                    ]
                },

                "INTJ": {
                overview: [
                    "INTJs are strategic, logical, and future-oriented thinkers who excel at solving complex problems and organizing systems. They are independent leaders with a drive to create meaningful structures."
                ],
                generalCharacteristics: [
                    "Strategic thinkers focused on the big picture.",
                    "Self-reliant and value knowledge, logic, and efficiency.",
                    "Calm, collected, and analytical.",
                    "Highly ambitious, creative, and innovative."
                ],
                strengths: [
                    "Self-confident and capable.",
                    "Take relationships seriously and are good listeners.",
                    "Efficient and handle conflict logically.",
                    "Highly intelligent and competent."
                ],
                weaknesses: [
                    "Insensitive to emotions and struggle with affection.",
                    "Believe they are always right, reluctant to accept blame.",
                    "Constantly seeking improvement can strain relationships."
                ],
                careerSuggestions: [
                    "Investment Banker", "Software Developer", "Economist", "Executive"
                ]
            },
            "INTP": {
                overview: [
                    "INTPs are deep thinkers focused on abstract ideas, constantly seeking to solve complex problems. Independent and original, they excel at forming new ideas but may struggle with practical tasks or emotions."
                ],
                generalCharacteristics: [
                    "Driven by abstract theories and ideas.",
                    "Value knowledge, independence, and innovation.",
                    "Detached from practical details, focusing on the big picture.",
                    "Creative and insightful, generating unique solutions."
                ],
                strengths: [
                    "Highly imaginative and enthusiastic about ideas.",
                    "Laid-back and handle criticism well.",
                    "Affectionate in a pure, childlike way with loved ones."
                ],
                weaknesses: [
                    "Struggle with emotional expression and practical matters.",
                    "Avoid conflict or overreact in anger.",
                    "Distrust others and find it hard to leave bad relationships."
                ],
                careerSuggestions: [
                    "Software Designer", "Economist", "College Professor", "Architect"
                ]
            },
            "ISFJ": {
                overview: [
                    "ISFJs are warm, dependable individuals who focus on practical details and the needs of others. They value tradition, security, and harmony, striving to fulfill their obligations."
                ],
                generalCharacteristics: [
                    "Sensitive to others' feelings and highly observant.",
                    "Value stability, tradition, and structured environments.",
                    "Service-oriented, creating order and maintaining harmony."
                ],
                strengths: [
                    "Warm, generous, and excellent at fulfilling responsibilities.",
                    "Strong organizational and practical skills.",
                    "Attentive listeners who value lifelong relationships."
                ],
                weaknesses: [
                    "Neglect their own needs for others.",
                    "Avoid conflict and criticism.",
                    "Struggle to leave bad relationships or embrace change."
                ],
                careerSuggestions: [
                    "Dentist", "Teacher", "Librarian", "Customer Service Representative"
                ]
            },
            "ISFP": {
                overview: [
                    "ISFPs are quiet, sensitive, and creative individuals who prioritize living by their values. They enjoy aesthetics and contributing to others' well-being, valuing personal freedom and caring deeply for others."
                ],
                generalCharacteristics: [
                    "Highly aware of sensory experiences and aesthetics.",
                    "Live in the moment with strong personal values.",
                    "Independent and reserved, yet deeply caring."
                ],
                strengths: [
                    "Warm, empathetic, and service-oriented.",
                    "Good at handling practical concerns and expressing affection through actions.",
                    "Appreciate beauty and create pleasing environments."
                ],
                weaknesses: [
                    "Avoid long-term planning and structured routines.",
                    "Sensitive to conflict and need personal space.",
                    "Reluctant to express thoughts and feelings."
                ],
                careerSuggestions: [
                    "Photographer", "Animal Care Specialist", "Fashion Designer"
                ]
            },
            "ISTJ": {
                overview: [
                    "ISTJs are organized, dependable individuals who value tradition and fulfilling their duties. They are methodical and efficient, with a strong sense of responsibility and respect for facts."
                ],
                generalCharacteristics: [
                    "Highly organized, methodical, and loyal.",
                    "Prefer practical applications and stability.",
                    "Natural leaders with high standards for commitments."
                ],
                strengths: [
                    "Dependable, responsible, and good at managing practical concerns.",
                    "Communicate clearly and handle conflict without emotional disruption.",
                    "Effective leaders who honor commitments."
                ],
                weaknesses: [
                    "Rigid in structure and resistant to change.",
                    "Struggle with emotional attunement and offering praise."
                ],
                careerSuggestions: [
                    "Accountant", "Web Development Engineer", "Government Employee"
                ]
            },
            "ISTP": {
                overview: [
                    "ISTPs are action-oriented, independent, and logical individuals with a deep interest in how things work. They thrive in hands-on tasks and excel in crisis situations, valuing variety and practical problem-solving."
                ],
                generalCharacteristics: [
                    "Logical analysts focused on understanding systems.",
                    "Independent, action-oriented, and practical.",
                    "Thrive in hands-on, results-driven environments."
                ],
                strengths: [
                    "Good listeners, optimistic, and handle crises well.",
                    "Respect others' space and solve problems efficiently."
                ],
                weaknesses: [
                    "Struggle with long-term commitments and emotions.",
                    "Overly private and may stir excitement or conflict for action."
                ],
                careerSuggestions: [
                    "Civil Engineer", "Pilot", "Emergency Room Physician"
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
    const description = Array.from(document.getElementById("personality-description").children).map(item => item.textContent).join("\n");
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
    doc.text(personalityType, 70, y,);
    y += 10;

    // Description
    doc.setFont("Helvetica", "bold");
    doc.text("Description:", 10, y);
    y += 7;
    doc.setFont("Helvetica", "normal");

    const descLines = doc.splitTextToSize(description, 180);
    descLines.forEach(line => {
        doc.text(line, 10, y);
        y += 7;
        if (y > 270) { doc.addPage(); y = 20; }
    });

    // Add spacing before career path
    y += 10;

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
