<div class="modal fade" id="createClassQuizModal" tabindex="-1" aria-labelledby="createClassQuizModa" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form action="/create_class_quiz" method="post">
                @csrf
                <input type="hidden" name="class_id" value="{{$class->id}}">
                <div class="modal-body">
                    <h3 class="text-primary text-center">{{$class->name}} Quiz</h3>
                    <label for="num_questions">Number of Question? <small>Minimum is 3</small></label>
                    <select name="num_questions" id="num_questions" class="form-select" onchange="generateInputs()" required>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <div class="border-top p-3">
                        <div class="p-3 mt-3">
                            <label for="question_1">Question 1</label>
                            <input type="text" name="question_1" id="question_1" class="form-control">
                            <div class="row">
                                <div class="col">
                                    <label for="q1_opt_1">Question 1 Option 1</label>
                                    <input type="text" name="q1_opt_1" id="q1_opt_1" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="q1_opt_2">Question 1 Option 2</label>
                                    <input type="text" name="q1_opt_2" id="q1_opt_2" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="q1_opt_3">Question 1 Option 3</label>
                                    <input type="text" name="q1_opt_3" id="q1_opt_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="q1_correct">Question 1 Correct Answer</label>
                                    <input type="text" name="q1_correct" id="q1_correct" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="p-3 mt-3">
                            <label for="question_2">Question 2</label>
                            <input type="text" name="question_2" id="question_2" class="form-control">
                            <div class="row">
                                <div class="col">
                                    <label for="q2_opt_1">Question 2 Option 1</label>
                                    <input type="text" name="q2_opt_1" id="q2_opt_1" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="q2_opt_2">Question 2 Option 2</label>
                                    <input type="text" name="q2_opt_2" id="q2_opt_2" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="q2_opt_3">Question 2 Option 3</label>
                                    <input type="text" name="q2_opt_3" id="q2_opt_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="q2_correct">Question 2 Correct Answer</label>
                                    <input type="text" name="q2_correct" id="q2_correct" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border mt-3">
                            <label for="question_3">Question 3</label>
                            <input type="text" name="question_3" id="question_3" class="form-control">
                            <div class="row">
                                <div class="col">
                                    <label for="q3_opt_1">Question 3 Option 1</label>
                                    <input type="text" name="q3_opt_1" id="q3_opt_1" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="q3_opt_2">Question 3 Option 2</label>
                                    <input type="text" name="q3_opt_2" id="q3_opt_2" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="q3_opt_3">Question 3 Option 3</label>
                                    <input type="text" name="q3_opt_3" id="q3_opt_3" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="q3_correct">Question 3 Correct Answer</label>
                                    <input type="text" name="q3_correct" id="q3_correct" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top p-3" id="additional-questions">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function generateInputs() {
        let i = document.getElementById('num_questions').value;
        let parentDiv = document.getElementById('additional-questions');
        parentDiv.innerHTML = "";
        for ( x = 4; x <= i; x++) {
            let fieldset = document.createElement("div");
            fieldset.innerHTML = `
             <div class='p-3 mt-3'>
             <label for="question_${x}">Question ${x}</label>
             <input type="text" name="question_${x}" id="question_${x}" class="form-control">
                 <div class="row">
                    <div class="col">
                        <label for="q${x}_opt_1">Question ${x} Option 1</label>
                        <input type="text" name="q${x}_opt_1" id="q${x}_opt_1" class="form-control">
                    </div>
                    <div class="col">
                        <label for="q${x}_opt_2">Question ${x} Option 2</label>
                        <input type="text" name="q${x}_opt_2" id="q${x}_opt_2" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="q${x}_opt_3">Question ${x} Option 3</label>
                        <input type="text" name="q${x}_opt_3" id="q${x}_opt_3" class="form-control">
                    </div>
                    <div class="col">
                        <label for="q${x}_correct">Question ${x} Correct Answer</label>
                        <input type="text" name="q${x}_correct" id="q${x}_correct" class="form-control">
                    </div>
                </div>
                </div>
             `;
            parentDiv.appendChild(fieldset);
        }
    }
</script>
