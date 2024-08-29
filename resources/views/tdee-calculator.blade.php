<x-app-layout>
    <div class="container" style="margin-top: 7.5rem; font-family: 'Roboto', sans-serif;">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4"><i class="fas fa-calculator"></i> Công cụ tính TDEE</h2>
                        <div class="row">
                            <!-- Cột trái chứa form -->
                            <div class="col-md-6">
                                <form id="tdeeForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="age">Tuổi</label>
                                            <input type="number" id="age" class="form-control" min="12" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gender">Giới tính</label>
                                            <select id="gender" class="form-control">
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="height">Chiều cao (cm)</label>
                                            <input type="number" id="height" class="form-control" min="100" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="weight">Cân nặng (kg)</label>
                                            <input type="number" id="weight" class="form-control" min="10" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="activity">Cường độ tập luyện</label>
                                        <select id="activity" class="form-control">
                                            <option value="1.2">Ít hoạt động, chỉ ăn đi làm về ngủ</option>
                                            <option value="1.375">Hoạt động nhẹ (tập thể dục 1-3 ngày/tuần)</option>
                                            <option value="1.55">Hoạt động vừa phải (tập thể dục 3-5 ngày/tuần)</option>
                                            <option value="1.725">Hoạt động nặng (tập thể dục 6-7 ngày/tuần)</option>
                                            <option value="1.9">Rất nặng (tập thể dục nhiều, làm công việc thể chất)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="goal">Mục tiêu</label>
                                        <select id="goal" class="form-control">
                                            <option value="maintain">Duy trì cân nặng</option>
                                            <option value="lose">Giảm cân</option>
                                            <option value="gain">Tăng cân</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn btn-primary btn-block" onclick="calculateTDEE()">Tính TDEE</button>
                                </form>
                            </div>

                            <!-- Cột phải chứa phần Các chỉ số cần biết -->
                            <div class="col-md-6">
                                <div class="explanation">
                                    <h4>Các chỉ số cần biết</h4>
                                    <ul style="list-style-type: disc">
                                        <li><strong>TDEE (Total Daily Energy Expenditure):</strong> Tổng số năng lượng bạn tiêu thụ trong một ngày, bao gồm cả năng lượng cần thiết cho các hoạt động cơ bản và các hoạt động khác.</li>
                                        <li><strong>BMR (Basal Metabolic Rate):</strong> Tỷ lệ trao đổi chất cơ bản, lượng calo cơ thể cần để duy trì các chức năng sinh lý cơ bản trong trạng thái nghỉ ngơi.</li>
                                        <li><strong>Cường độ tập luyện:</strong> Mức độ hoạt động thể chất hàng ngày của bạn, ảnh hưởng đến lượng calo cần thiết cho cơ thể.</li>
                                        <li><strong>Mục tiêu:</strong> Mục tiêu cân nặng của bạn, ảnh hưởng đến lượng calo bạn cần tiêu thụ để duy trì, giảm hoặc tăng cân.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div id="result" class="result-box mt-4 d-none">
                            <h4 class="text-center"><i class="fas fa-clipboard-check"></i> Kết quả</h4>
                            <p id="tdeeResult"></p>
                            <p id="bmrResult"></p>
                            <p id="goalResult"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // function calculateTDEE() {
        //     var age = parseInt(document.getElementById('age').value);
        //     var gender = document.getElementById('gender').value;
        //     var height = parseInt(document.getElementById('height').value);
        //     var weight = parseInt(document.getElementById('weight').value);
        //     var activity = parseFloat(document.getElementById('activity').value);
        //     var goal = document.getElementById('goal').value;

        //     var bmr = 10 * weight + 6.25 * height - 5 * age + (gender === 'male' ? 5 : -161);
        //     var tdee = bmr * activity;

        //     document.getElementById('tdeeResult').innerText = 'TDEE của bạn là: ' + tdee.toFixed(2) + ' calo/ngày';
        //     document.getElementById('bmrResult').innerText = 'BMR của bạn là: ' + bmr.toFixed(2) + ' calo/ngày';
        //     document.getElementById('goalResult').innerText = 'Mục tiêu của bạn là: ' + goal;
        //     document.getElementById('goalResult').innerText = `Lượng calo cần thiết để bạn ${goal === 'lose' ? 'giảm cân' : goal === 'gain' ? 'tăng cân' : 'duy trì cân nặng'} là: ${goalCalories.toFixed(2)} calo một ngày`;

        //     document.getElementById('result').classList.remove('d-none');
        // }

        function calculateTDEE() {
            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;
            const height = document.getElementById('height').value;
            const weight = document.getElementById('weight').value;
            const activity = document.getElementById('activity').value;
            const goal = document.getElementById('goal').value;

            let bmr;
            if (gender === 'male') {
                bmr = 66 + (13.7 * weight) + (5 * height) - (6.8 * age);
            } else {
                bmr = 655 + (9.6 * weight) + (1.8 * height) - (4.7 * age);
            }

            const tdee = bmr * activity;

            let goalCalories;
            if (goal === 'lose') {
                goalCalories = tdee - 400;
            } else if (goal === 'gain') {
                goalCalories = tdee + 400;
            } else {
                goalCalories = tdee;
            }

            document.getElementById('tdeeResult').innerHTML =
                `Chỉ số <b>TDEE</b> của bạn là: <b>${tdee.toFixed(2)}</b> calo một ngày`;
            document.getElementById('bmrResult').innerHTML =
                `Chỉ số <b>BMR</b> của bạn là: <b>${bmr.toFixed(2)}</b> calo cần nạp một ngày`;
            document.getElementById('goalResult').innerHTML =
                `Lượng calo cần thiết để bạn <b>${goal === 'lose' ? 'giảm cân' : goal === 'gain' ? 'tăng cân' : 'duy trì cân nặng'}</b> là: <b>${goalCalories.toFixed(2)}</b> calo một ngày`;


            document.getElementById('result').classList.remove('d-none');
        }
    </script>
    <style>
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 30px;
        }

        h2.card-title {
            color: #9b59b6;
            font-weight: bold;
            font-size: 28px;
        }

        .explanation {
            border: none;
            background-color: #f1f2f6;
            color: #333;
            padding: 20px 20px 20px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .explanation h4 {
            color: #2980b9;
            padding: 10px 0 10px 0;
        }

        .form-control {
            border-radius: 5px;
            border: 2px solid #ddd;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #9b59b6;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #9b59b6;
            border-color: #9b59b6;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8e44ad;
        }

        .result-box {
            background-color: #dff9fb;
            color: #1e272e;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .result-box h4 {
            color: #27ae60;
            font-weight: bold;
        }

        #tdeeForm button {
            margin-top: 20px;
        }
    </style>
</x-app-layout>
