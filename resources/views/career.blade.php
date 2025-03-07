@vite(['resources/css/career.css', 'resources/js/career.js', 'resources/js/mbtiData.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Career Match') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12">
        <div class="quiz-container">
            <title>Free Personality Test</title>
            <script src="https://cdn.tailwindcss.com"></script>
        

        <section id="test-section" class="text-center py-10">
            <h2 class="text-4xl font-bold">Free <span class="text-purple-600">Personality Test</span></h2>
            <p class="description">
                It takes less than 10 minutes to get a detailed understanding of your personality and the reasons you do the things you do. Get a detailed report customized for you!
            </p>
            <button class="start-btn" id="start-instructions">TAKE YOUR TEST →</button>
        </section>

        <section class="image-section" id="images-section">
            <div class="image-container"><img src="{{ asset('images/test1.png') }}" alt="Personality Type 1"></div>
            <div class="image-container"><img src="{{ asset('images/test2.png') }}" alt="Personality Type 1"></div>
            <div class="image-container"><img src="{{ asset('images/test3.png') }}" alt="Personality Type 1"></div>
            <div class="image-container"><img src="{{ asset('images/test4.png') }}" alt="Personality Type 1"></div>
        </section>

        <div id="instructions" class="instructions">
            <p class="instructions-title">INSTRUCTIONS</p>
            <ul>
                <li>There are no right answers to any of these questions.</li>
                <li>Answer the questions quickly, do not over-analyze them.</li>
                <li>Answer as “<b>the way you are</b>”, not “<b>the way you’d like to be seen by others</b>”.</li>
            </ul>
            <br>
            <button id="start-btn" onclick="startQuiz()" class="quiz-btn">START QUIZ</button>
        </div>

        <div id="progress-bar-container" class="hidden">
            <div id="progress-bar"></div>
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

                <h3 class="font-semibold mt-4">Overview</h3>
                <ul id="overview" class="list-disc ml-4"></ul>

                <h3 class="font-semibold mt-4">General Characteristics</h3>
                <ul id="general-characteristics" class="list-disc ml-4"></ul>

                <h3 class="font-semibold mt-4">Strengths</h3>
                <ul id="strengths" class="list-disc ml-4"></ul>

                <h3 class="font-semibold mt-4">Potential Weaknesses</h3>
                <ul id="weaknesses" class="list-disc ml-4"></ul>

                <h2 class="font-semibold mt-4">Recommended Career Paths:</h2>
                <ul id="career-list" class="list-disc ml-4"></ul>

                <canvas id="mbti-chart" width="30" height="10"></canvas>
                <p>&nbsp;</p>
                <button id="downloadPDF(userMBTI)" class="btn-download">Download PDF</button>
                <button id="restart-btn" class="btn-restart">Restart Quiz</button>
            </div>
            </div>
        </div>
    </div>
</div>
</div>

</x-app-layout>