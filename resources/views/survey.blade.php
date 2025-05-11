<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Survey Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }

        header {
            background: #4A90E2;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 1.5rem;
        }

        .form-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        form {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        h3 {
            color: #4A90E2;
            margin: 15px 0 5px;
            font-size: 1.2rem;
        }

        select,
        input[type=email],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f9f9f9;
            font-size: 1rem;
        }

        select:focus,
        input:focus,
        textarea:focus {
            border-color: #4A90E2;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        label {
            font-size: 1rem;
            margin-right: 10px;
        }

        input[type=checkbox] {
            margin-right: 8px;
        }

        button {
            background: #4A90E2;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background: #357ABD;
        }

        footer {
            background: #4A90E2;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .alert {
            padding: 15px;
            border-radius: 4px;
            margin: 10px;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert ul {
            list-style: none;
        }

        .alert ul li {
            margin-bottom: 5px;
        }

        .star-rating {
            display: flex;
            justify-content: center;
            font-size: 3.5rem;
            color: #ccc;
            margin: 10px 0;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label.star {
            cursor: pointer;
            padding: 0 8px;
            transition: transform 0.2s, color 0.2s, opacity 0.3s;
            opacity: 1;
        }

        .star-rating label.star.hovered,
        .star-rating label.star.selected {
            color: #ffcc00;
            transform: scale(2);
        }
    </style>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <header>
        <h1>Customer Feedback Survey</h1>
    </header>
    <div class="form-container">
        <form action="{{ route('store') }}" method="POST">
            @csrf

            <h3>1. What is your email address?</h3>
            <input type="email" name="email" required placeholder="Enter your email">

            <h3>2. What is your age range?</h3>
            <select name="age_range" required>
                <option value="">-- Select --</option>
                <option value="under_18">Under 18</option>
                <option value="18_24">18–24</option>
                <option value="25_34">25–34</option>
                <option value="35_44">35–44</option>
                <option value="45_plus">45+</option>
            </select>

            <h3>3. What is your gender?</h3>
            <select name="gender" required>
                <option value="">-- Select --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <h3>4. How satisfied are you with our product/service?</h3>
            <select name="satisfaction" required>
                <option value="">-- Select --</option>
                <option value="very_satisfied">Very satisfied</option>
                <option value="satisfied">Satisfied</option>
                <option value="neutral">Neutral</option>
                <option value="dissatisfied">Dissatisfied</option>
                <option value="very_dissatisfied">Very dissatisfied</option>
            </select>

            <h3>5. How often do you use our product/service?</h3>
            <select name="usage_frequency" required>
                <option value="">-- Select --</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="rarely">Rarely</option>
                <option value="never">Never</option>
            </select>

            <h3>6. How likely are you to recommend us? (1–5 stars)</h3>
            <div class="star-rating">
                <input type="radio" id="star1" name="stars" value="1-star" required>
                <label for="star1" class="star">&#9733;</label>
                <input type="radio" id="star2" name="stars" value="2-star">
                <label for="star2" class="star">&#9733;</label>
                <input type="radio" id="star3" name="stars" value="3-star">
                <label for="star3" class="star">&#9733;</label>
                <input type="radio" id="star4" name="stars" value="4-star">
                <label for="star4" class="star">&#9733;</label>
                <input type="radio" id="star5" name="stars" value="5-star">
                <label for="star5" class="star">&#9733;</label>
            </div>

            <button type="submit">Submit Survey</button>
        </form>
    </div>

    <footer>&copy;2025 All Rights Reserved.</footer>

    <script>
document.addEventListener("DOMContentLoaded", () => {

    const labels = Array.from(document.querySelectorAll(".star-rating label.star"));
    const inputs = Array.from(document.querySelectorAll(".star-rating input"));

    labels.forEach((label, index) => {
        label.addEventListener("mouseover", () => {
            updateHoveredStars(index);
        });

        label.addEventListener("mouseout", () => {
            resetHoverState();
            updateSelectedStars();
        });
    });

    labels.forEach((label, index) => {
        label.addEventListener("click", () => {
            inputs[index].checked = true;
            resetAllStars();
            animateStarSelection(index);
        });
    });

    function updateHoveredStars(hoverIndex) {
        labels.forEach((label, index) => {
            label.classList.toggle("hovered", index <= hoverIndex);
        });
    }

    function resetHoverState() {
        labels.forEach(label => {
            label.classList.remove("hovered");
        });
    }

    function updateSelectedStars() {
        const selectedIndex = inputs.findIndex(input => input.checked);
        if (selectedIndex >= 0) {
            labels.forEach((label, index) => {
                label.classList.toggle("selected", index <= selectedIndex);
            });
        }
    }

    function resetAllStars() {
        labels.forEach(label => {
            label.style.opacity = 0;
            label.classList.remove("selected");
        });
    }


    function animateStarSelection(selectedIndex) {
        setTimeout(() => {
            labels.forEach((label, index) => {
                setTimeout(() => {
                    label.style.opacity = 1;  
                    if (index <= selectedIndex) label.classList.add("selected");  
                }, index * 100);  
            });
        }, 500);
    }
});

    </script>
</body>

</html>
