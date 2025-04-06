<?php include "session_check.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaxBot AI - Forecasting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #FF6B35;
            --secondary: #2D3142;
            --accent: #4CAF50;
            --lightbg: #F7F9FC;
            --cardbg: rgba(255, 255, 255, 0.95);
            --gradient: linear-gradient(135deg, #FF6B35, #FF8C66);
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --neumo-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.9);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--lightbg);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }
        .navbar {
            background: var(--gradient);
            padding: 1rem 2rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }
        .nav-links {
            display: none;
            gap: 2rem;
            align-items: center;
        }
        @media (min-width: 768px) {
            .nav-links { display: flex; }
        }
        .nav-links a, .nav-links button {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-links a:hover, .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
        }
        .nav-links button {
            background: white;
            color: var(--primary);
            border: none;
            cursor: pointer;
            font-weight: 600;
        }
        .nav-links button:hover {
            background: #F0F0F0;
            box-shadow: var(--shadow);
        }
        .mobile-menu-btn {
            display: block;
            font-size: 1.5rem;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
        }
        @media (min-width: 768px) {
            .mobile-menu-btn { display: none; }
        }
        .mobile-menu {
            display: none;
            background: var(--cardbg);
            padding: 1rem;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            box-shadow: var(--shadow);
        }
        .mobile-menu.active { display: block; }
        .mobile-menu a, .mobile-menu button {
            display: block;
            color: var(--secondary);
            padding: 0.5rem;
            text-decoration: none;
            font-weight: 500;
        }
        .mobile-menu button {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            width: 100%;
            margin-top: 0.5rem;
        }
        .container {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        .header {
            margin-bottom: 2rem;
            text-align: center;
        }
        h1 {
            font-size: 2.2rem;
            color: var(--secondary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .card {
            background: var(--cardbg);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--neumo-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            font-size: 1.5rem;
            color: var(--secondary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .card p {
            font-size: 1rem;
            color: var(--secondary);
            opacity: 0.8;
            margin-bottom: 1rem;
        }
        .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0.5rem 0;
        }
        .btn {
            width: auto;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            background: var(--gradient);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: flex-start;
        }
        .btn:hover {
            background: linear-gradient(135deg, #e65a2e, #FF6B35);
            box-shadow: 0 0 15px rgba(255, 107, 53, 0.5);
        }
        canvas {
            max-width: 100%;
            margin-top: 1rem;
            height: 300px;
        }
        ul {
            list-style: disc;
            padding-left: 1.5rem;
            color: var(--secondary);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <span class="nav-logo">TaxBot AI</span>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="taxy.php">Tax Planner</a>
            <a href="analysis.php">Analysis</a>
            <a href="forecasting.php" class="active">Forecasting</a>
            <button onclick="logout()">Logout</button>
        </div>
        <button class="mobile-menu-btn" id="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="mobile-menu" id="mobile-menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="taxy.php">Tax Planner</a>
        <a href="analysis.php">Analysis</a>
        <a href="forecasting.php">Forecasting</a>
        <button onclick="logout()">Logout</button>
    </div>
</nav>
<div class="container">
    <div class="header">
        <h1><i class="fas fa-chart-line"></i> Financial Forecasting</h1>
    </div>
    <div class="section">
        <div class="card">
            <h2><i class="fas fa-money-bill-wave"></i> Income & Expense Forecast</h2>
            <canvas id="incomeExpenseChart"></canvas>
            <p id="incomeExpenseInsight">Based on current trends, your income and expenses will evolve over the next 10 years.</p>
        </div>
        <div class="card">
            <h2><i class="fas fa-tax"></i> Tax Liability Forecast</h2>
            <canvas id="taxChart"></canvas>
            <p id="taxInsight">Projected tax liability with current regime and deductions.</p>
        </div>
        <div class="card">
            <h2><i class="fas fa-piggy-bank"></i> Savings & Investment Plan</h2>
            <canvas id="savingsChart"></canvas>
            <ul id="investmentAdvice"></ul>
        </div>
        <div class="card">
            <h2><i class="fas fa-retire"></i> Retirement Planning</h2>
            <p><strong>Projected Retirement Corpus:</strong> <span id="retirementCorpus" class="value">₹0</span></p>
            <ul id="retirementAdvice"></ul>
            <!--<button class="btn" onclick="adjustPlan()"><i class="fas fa-edit"></i> Adjust Plan</button>-->
        </div>
    </div>
</div>
<script>
    let incomeExpenseChart, taxChart, savingsChart;

    function logout() {
        localStorage.removeItem('isLoggedIn');
        window.location.href = 'taxbot-ai.html';
    }

    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('active');
    });

    // Simulated data aggregation from other pages
    function fetchUserData() {
        const dashboardData = {
            income: 550000,
            expenses: 45000 * 12,
            savings: 550000 - (45000 * 12)
        };
        const taxPlannerData = JSON.parse(localStorage.getItem('taxPlannerData') || '{}') || {
            totalIncome: 1000000,
            totalDeductions: 200000,
            taxableIncome: 630000,
            totalTax: 45000,
            regime: 'old'
        };
        const analysisData = {
            grossSalary: 1000000,
            tds: 75000,
            deductions: 200000
        };
        return {
            income: Math.max(dashboardData.income, taxPlannerData.totalIncome, analysisData.grossSalary),
            expenses: dashboardData.expenses,
            savings: dashboardData.savings,
            taxableIncome: taxPlannerData.taxableIncome,
            totalTax: taxPlannerData.totalTax,
            deductions: taxPlannerData.totalDeductions,
            regime: taxPlannerData.regime
        };
    }

    function forecastData() {
        const data = fetchUserData();
        const forecastYears = 10;
        const incomeGrowthRate = 1.05;
        const expenseGrowthRate = 1.03;
        const inflationRate = 1.04;
        const investmentReturn = 1.07;

        let forecasts = {
            income: [],
            expenses: [],
            savings: [],
            tax: [],
            cumulativeSavings: []
        };

        let currentIncome = data.income;
        let currentExpenses = data.expenses;
        let currentSavings = data.savings;
        let currentTaxableIncome = data.taxableIncome;
        let cumulativeSavings = data.savings;

        for (let year = 0; year < forecastYears; year++) {
            forecasts.income.push(currentIncome);
            forecasts.expenses.push(currentExpenses);
            forecasts.savings.push(currentSavings);
            forecasts.tax.push(data.regime === 'old' ? calculateOldRegimeTax(currentTaxableIncome) : calculateNewRegimeTax(currentTaxableIncome));
            cumulativeSavings = (cumulativeSavings + currentSavings) * investmentReturn;
            forecasts.cumulativeSavings.push(cumulativeSavings);

            currentIncome *= incomeGrowthRate;
            currentExpenses *= expenseGrowthRate;
            currentSavings = currentIncome - currentExpenses - forecasts.tax[year];
            currentTaxableIncome = currentIncome - data.deductions * inflationRate;
        }

        return forecasts;
    }

    function calculateOldRegimeTax(taxableIncome) {
        let tax = 0;
        if (taxableIncome > 250000) tax += Math.min(taxableIncome - 250000, 250000) * 0.05;
        if (taxableIncome > 500000) tax += Math.min(taxableIncome - 500000, 500000) * 0.20;
        if (taxableIncome > 1000000) tax += (taxableIncome - 1000000) * 0.30;
        return tax + (tax * 0.04);
    }

    function calculateNewRegimeTax(taxableIncome) {
        let tax = 0;
        if (taxableIncome > 300000) tax += Math.min(taxableIncome - 300000, 300000) * 0.05;
        if (taxableIncome > 600000) tax += Math.min(taxableIncome - 600000, 300000) * 0.10;
        if (taxableIncome > 900000) tax += Math.min(taxableIncome - 900000, 300000) * 0.15;
        if (taxableIncome > 1200000) tax += Math.min(taxableIncome - 1200000, 300000) * 0.20;
        if (taxableIncome > 1500000) tax += (taxableIncome - 1500000) * 0.30;
        return tax + (tax * 0.04);
    }

    function renderForecasts() {
        const forecasts = forecastData();
        const years = Array.from({ length: 10 }, (_, i) => 2025 + i);

        // Income & Expense Chart
        incomeExpenseChart = new Chart(document.getElementById('incomeExpenseChart'), {
            type: 'line',
            data: {
                labels: years,
                datasets: [
                    { label: 'Income', data: forecasts.income, borderColor: '#FF6B35', fill: false },
                    { label: 'Expenses', data: forecasts.expenses, borderColor: '#2D3142', fill: false }
                ]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
        document.getElementById('incomeExpenseInsight').textContent = `Projected income grows at 5% annually, while expenses rise at 3%. Savings potential in Year 10: ₹${(forecasts.income[9] - forecasts.expenses[9] - forecasts.tax[9]).toLocaleString('en-IN')}.`;

        // Tax Liability Chart
        taxChart = new Chart(document.getElementById('taxChart'), {
            type: 'line',
            data: {
                labels: years,
                datasets: [{ label: 'Tax Liability', data: forecasts.tax, borderColor: '#4CAF50', fill: false }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
        document.getElementById('taxInsight').textContent = `Tax liability in Year 10: ₹${forecasts.tax[9].toLocaleString('en-IN')}. Optimize deductions to reduce this burden.`;

        // Savings Chart
        savingsChart = new Chart(document.getElementById('savingsChart'), {
            type: 'line',
            data: {
                labels: years,
                datasets: [{ label: 'Cumulative Savings', data: forecasts.cumulativeSavings, borderColor: '#FF8C66', fill: false }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Investment Advice
        const investmentAdvice = document.getElementById('investmentAdvice');
        investmentAdvice.innerHTML = '';
        const remaining80C = 150000 - (fetchUserData().deductions > 150000 ? 150000 : fetchUserData().deductions);
        if (remaining80C > 0) {
            investmentAdvice.innerHTML += `<li>Invest ₹${remaining80C.toLocaleString('en-IN')} more in 80C (PPF/ELSS) to save ₹${(remaining80C * 0.30).toLocaleString('en-IN')} annually.</li>`;
        }
        investmentAdvice.innerHTML += `<li>Equity MFs at 7-10% returns could grow ₹${forecasts.savings[0].toLocaleString('en-IN')} yearly savings to ₹${forecasts.cumulativeSavings[9].toLocaleString('en-IN')} in 10 years.</li>`;
        investmentAdvice.innerHTML += `<li>Diversify with fixed deposits or bonds for stability.</li>`;

        // Retirement Planning
        const retirementAge = 60;
        const currentAge = 30; // Assumption
        const yearsToRetirement = retirementAge - currentAge;
        const retirementCorpus = forecasts.cumulativeSavings[9] * Math.pow(1.07, yearsToRetirement - 10);
        document.getElementById('retirementCorpus').textContent = `₹${retirementCorpus.toLocaleString('en-IN')}`;
        const retirementAdvice = document.getElementById('retirementAdvice');
        retirementAdvice.innerHTML = '';
        retirementAdvice.innerHTML += `<li>Target ₹${(retirementCorpus * 1.5).toLocaleString('en-IN')} corpus for a comfortable retirement (inflation-adjusted).</li>`;
        retirementAdvice.innerHTML += `<li>Increase NPS contribution by ₹50,000/year for tax-free growth.</li>`;
        retirementAdvice.innerHTML += `<li>Plan for ₹${(forecasts.expenses[9] * 0.8).toLocaleString('en-IN')}/year post-retirement expenses.</li>`;
    }

    function adjustPlan() {
        alert('Feature coming soon: Adjust income growth, expenses, and investment rates.');
    }

    window.onload = function() {
        renderForecasts();
    };
</script>
</body>
</html>