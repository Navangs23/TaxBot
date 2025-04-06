<?php include "session_check.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimate Indian Tax Planner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root {
            --primary: #FF6B35;
            --secondary: #2D3142;
            --accent: #4CAF50;
            --lightbg: #F5F6F5;
            --cardbg: rgba(255, 255, 255, 0.8);
            --gradient: linear-gradient(135deg, #FF6B35, #FF8C66);
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --neumo-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.7);
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--lightbg);
            margin: 0;
            transition: background 0.3s;
        }
        body.dark-mode {
            --primary: #FF8C66;
            --secondary: #D3D3D3;
            --accent: #66BB6A;
            --lightbg: #1E1E1E;
            --cardbg: rgba(30, 30, 30, 0.8);
            background: var(--lightbg);
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
        .hero {
            background: var(--gradient);
            padding: 4rem 1rem;
            text-align: center;
            color: white;
        }
        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 768px) {
            .hero h1 { font-size: 3.75rem; }
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1rem;
        }
        .section h2 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: var(--secondary);
            margin-bottom: 3rem;
        }
        .grid {
            display: grid;
            gap: 2rem;
        }
        @media (min-width: 768px) {
            .grid-2 { grid-template-columns: 2fr 1fr; }
        }
        .card {
            background: var(--cardbg);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--neumo-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            animation: slideIn 0.5s ease-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        .input-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }
        input, select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.5);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: background 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .btn-primary {
            background: #FF6B35;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background: #e65a2e;
            box-shadow: 0 0 10px #FF6B35;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
            color: var(--secondary);
        }
        th {
            background: #FF6B35;
            color: white;
        }
        tr:nth-child(even) {
            background: rgba(0, 0, 0, 0.05);
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        canvas { margin-top: 1.5rem; }
        ul { list-style: disc; padding-left: 1.25rem; color: var(--secondary); }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <span class="nav-logo">TaxBot AI</span>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="taxy.php" class="active">Tax Planner</a>
            <a href="analysis.php">Analysis</a>
            <a href="forecasting.php">Forecasting</a>
            <button onclick="logout()">Logout</button>
        </div>
        <button class="mobile-menu-btn" id="mobile-menu-button">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="mobile-menu" id="mobile-menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="taxy.php">Tax Planner</a>
        <a href="analysis.php">Analysis</a>
        <button onclick="logout()">Logout</button>
    </div>
</nav>

<div class="hero">
    <h1>Ultimate Indian Tax Planner 2025</h1>
    <p>Plan, optimize, and calculate your taxes with AI-powered precision</p>
</div>

<div id="calculator" class="section">
    <h2>Tax Planner</h2>
    <div class="grid grid-2">
        <div class="card">
            <h3 style="font-weight: 600; color: var(--secondary); margin-bottom: 1rem;">Income & Deductions</h3>
            <div class="input-group">
                <div>
                    <label>Age Category</label>
                    <select id="age">
                        <option value="below60">Below 60</option>
                        <option value="60to80">60-80 (Senior)</option>
                        <option value="above80">Above 80 (Super Senior)</option>
                    </select>
                </div>
                <div>
                    <label>Tax Regime</label>
                    <select id="regime">
                        <option value="new">New Regime</option>
                        <option value="old">Old Regime</option>
                    </select>
                </div>
                <div>
                    <label>Basic Salary (₹)</label>
                    <input id="salary" type="number" placeholder="e.g. 1000000">
                </div>
                <div>
                    <label>Other Income (₹)</label>
                    <input id="otherIncome" type="number" placeholder="e.g. 50000">
                </div>
                <div>
                    <label>Rent Paid (₹)</label>
                    <input id="rent" type="number" placeholder="Annual rent">
                </div>
                <div>
                    <label>HRA Received (₹)</label>
                    <input id="hraReceived" type="number" placeholder="Annual HRA">
                </div>
                <div>
                    <label>City Type</label>
                    <select id="cityType">
                        <option value="metro">Metro</option>
                        <option value="nonMetro">Non-Metro</option>
                    </select>
                </div>
                <div>
                    <label>Section 80C (₹)</label>
                    <input id="deduction80c" type="number" placeholder="Max 150000">
                </div>
                <div>
                    <label>Section 80D (₹)</label>
                    <input id="deduction80d" type="number" placeholder="Max 25000/50000">
                </div>
                <div>
                    <label>Section 80E (₹)</label>
                    <input id="deduction80e" type="number" placeholder="Education Loan Interest">
                </div>
                <div>
                    <label>Section 80G (₹)</label>
                    <input id="deduction80g" type="number" placeholder="Donations">
                </div>
                <div>
                    <label>Section 80TTA (₹)</label>
                    <input id="deduction80tta" type="number" placeholder="Max 10000">
                </div>
                <div>
                    <label>Home Loan Interest (₹)</label>
                    <input id="homeLoan" type="number" placeholder="Max 200000">
                </div>
                <div>
                    <label>NPS Contribution (₹)</label>
                    <input id="nps" type="number" placeholder="Max 50000">
                </div>
            </div>
            <div>
                <label>Upload Pre-filled JSON</label>
                <input id="jsonUpload" type="file" accept=".json" onchange="loadJSON(event)">
            </div>
            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button class="btn btn-primary" onclick="calculateTax()">Calculate Tax</button>
                <button class="btn btn-primary" onclick="exportToPDF()">Export to PDF</button>
            </div>
        </div>
        <div class="card" id="resultSection">
            <h3 style="font-weight: 600; color: var(--secondary); margin-bottom: 1rem;">Tax Analysis</h3>
            <table>
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (₹)</th>
                </tr>
                </thead>
                <tbody id="resultTable">
                <tr><td>Total Income</td><td id="totalIncome">0</td></tr>
                <tr><td>HRA Exemption</td><td id="hraExemption">0</td></tr>
                <tr><td>Total Deductions</td><td id="totalDeductions">0</td></tr>
                <tr><td>Taxable Income</td><td id="taxableIncome">0</td></tr>
                <tr><td>Tax Before Surcharge</td><td id="taxBeforeSurcharge">0</td></tr>
                <tr><td>Surcharge</td><td id="surcharge">0</td></tr>
                <tr><td>Health & Education Cess</td><td id="cess">0</td></tr>
                <tr style="font-weight: bold; color: var(--accent);"><td>Total Tax (Selected)</td><td id="totalTax">0</td></tr>
                <tr><td>Monthly Tax</td><td id="monthlyTax">0</td></tr>
                <tr><td>Old Regime Tax</td><td id="oldRegimeTax">0</td></tr>
                <tr><td>New Regime Tax</td><td id="newRegimeTax">0</td></tr>
                <tr style="font-weight: bold; color: var(--accent);"><td>Recommended Regime</td><td id="recommendedRegime">N/A</td></tr>
                </tbody>
            </table>
            <canvas id="taxChart"></canvas>
            <div style="margin-top: 1.5rem;">
                <h4 style="font-weight: 600; color: var(--secondary); margin-bottom: 0.5rem;">Detailed Insights</h4>
                <div id="insights" style="color: var(--secondary);"></div>
            </div>
            <div style="margin-top: 1.5rem;">
                <h4 style="font-weight: 600; color: var(--secondary); margin-bottom: 0.5rem;">Investment Planner</h4>
                <ul id="investmentPlan"></ul>
            </div>
            <div style="margin-top: 1.5rem;">
                <h4 style="font-weight: 600; color: var(--secondary); margin-bottom: 0.5rem;">Multi-Year Comparison</h4>
                <canvas id="yearlyChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    let taxChart, yearlyChart;

    function logout() {
        localStorage.removeItem('isLoggedIn');
        console.log('Redirecting to login page');
        window.location.href = 'taxbot-ai.html';
    }

    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('active');
    });

    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }

    function calculateHRAExemption(salary, rent, hraReceived, cityType) {
        const basicSalary = salary * 0.4;
        const metroFactor = cityType === 'metro' ? 0.5 : 0.4;
        return Math.min(hraReceived, rent - (basicSalary * 0.1), basicSalary * metroFactor);
    }

    function calculateTaxForRegime(regime, taxableIncome, age) {
        let tax = 0;
        if (regime === 'new') {
            if (taxableIncome <= 300000) tax = 0;
            else if (taxableIncome <= 600000) tax = (taxableIncome - 300000) * 0.05;
            else if (taxableIncome <= 900000) tax = 15000 + (taxableIncome - 600000) * 0.10;
            else if (taxableIncome <= 1200000) tax = 45000 + (taxableIncome - 900000) * 0.15;
            else if (taxableIncome <= 1500000) tax = 90000 + (taxableIncome - 1200000) * 0.20;
            else tax = 150000 + (taxableIncome - 1500000) * 0.30;
            if (taxableIncome <= 700000) tax = 0;
        } else {
            let exemptionLimit = age === 'below60' ? 250000 : age === '60to80' ? 300000 : 500000;
            if (taxableIncome <= exemptionLimit) tax = 0;
            else if (taxableIncome <= 500000) tax = (taxableIncome - exemptionLimit) * 0.05;
            else if (taxableIncome <= 1000000) tax = (500000 - exemptionLimit) * 0.05 + (taxableIncome - 500000) * 0.20;
            else tax = (500000 - exemptionLimit) * 0.05 + 500000 * 0.20 + (taxableIncome - 1000000) * 0.30;
            if (taxableIncome <= 500000) tax = 0;
        }
        return tax;
    }

    function applySurchargeAndCess(tax, taxableIncome) {
        let surcharge = 0;
        if (taxableIncome > 5000000 && taxableIncome <= 10000000) surcharge = tax * 0.10;
        else if (taxableIncome > 10000000 && taxableIncome <= 20000000) surcharge = tax * 0.15;
        else if (taxableIncome > 20000000 && taxableIncome <= 50000000) surcharge = tax * 0.25;
        else if (taxableIncome > 50000000) surcharge = tax * 0.37;
        const cess = (tax + surcharge) * 0.04;
        return { tax, surcharge, cess, total: tax + surcharge + cess };
    }

    function calculateSlabBreakdown(regime, taxableIncome, age) {
        const breakdown = [];
        if (regime === 'new') {
            if (taxableIncome > 300000) breakdown.push({ slab: '₹3L-6L', rate: '5%', amount: Math.min(taxableIncome - 300000, 300000) * 0.05 });
            if (taxableIncome > 600000) breakdown.push({ slab: '₹6L-9L', rate: '10%', amount: Math.min(taxableIncome - 600000, 300000) * 0.10 });
            if (taxableIncome > 900000) breakdown.push({ slab: '₹9L-12L', rate: '15%', amount: Math.min(taxableIncome - 900000, 300000) * 0.15 });
            if (taxableIncome > 1200000) breakdown.push({ slab: '₹12L-15L', rate: '20%', amount: Math.min(taxableIncome - 1200000, 300000) * 0.20 });
            if (taxableIncome > 1500000) breakdown.push({ slab: 'Above ₹15L', rate: '30%', amount: (taxableIncome - 1500000) * 0.30 });
        } else {
            let exemptionLimit = age === 'below60' ? 250000 : age === '60to80' ? 300000 : 500000;
            if (taxableIncome > exemptionLimit) breakdown.push({ slab: `${exemptionLimit/100000}L-5L`, rate: '5%', amount: Math.min(taxableIncome - exemptionLimit, 500000 - exemptionLimit) * 0.05 });
            if (taxableIncome > 500000) breakdown.push({ slab: '₹5L-10L', rate: '20%', amount: Math.min(taxableIncome - 500000, 500000) * 0.20 });
            if (taxableIncome > 1000000) breakdown.push({ slab: 'Above ₹10L', rate: '30%', amount: (taxableIncome - 1000000) * 0.30 });
        }
        return breakdown;
    }

    function loadJSON(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const jsonData = JSON.parse(e.target.result);
                populateFields(jsonData);
                calculateTax();
            } catch (error) {
                alert("Error parsing JSON file: " + error.message);
            }
        };
        reader.readAsText(file);
    }

    function populateFields(jsonData) {
        document.getElementById('salary').value = jsonData.salaryIncome || 0;
        document.getElementById('otherIncome').value = jsonData.otherIncome || 0;
        document.getElementById('hraReceived').value = jsonData.hra || 0;
        document.getElementById('rent').value = jsonData.rentPaid || 0;
        document.getElementById('deduction80c').value = jsonData.deductions?.section80C || 0;
        document.getElementById('deduction80d').value = jsonData.deductions?.section80D || 0;
        document.getElementById('deduction80e').value = jsonData.deductions?.section80E || 0;
        document.getElementById('deduction80g').value = jsonData.deductions?.section80G || 0;
        document.getElementById('deduction80tta').value = jsonData.deductions?.section80TTA || 0;
        document.getElementById('homeLoan').value = jsonData.deductions?.homeLoanInterest || 0;
        document.getElementById('nps').value = jsonData.deductions?.section80CCD1B || 0;
        if (jsonData.age) document.getElementById('age').value = jsonData.age < 60 ? 'below60' : jsonData.age < 80 ? '60to80' : 'above80';
        if (jsonData.cityType) document.getElementById('cityType').value = jsonData.cityType.toLowerCase() === 'metro' ? 'metro' : 'nonMetro';
    }

    function calculateTax() {
        const age = document.getElementById('age').value;
        const regime = document.getElementById('regime').value;
        const salary = parseFloat(document.getElementById('salary').value) || 0;
        const otherIncome = parseFloat(document.getElementById('otherIncome').value) || 0;
        const rent = parseFloat(document.getElementById('rent').value) || 0;
        const hraReceived = parseFloat(document.getElementById('hraReceived').value) || 0;
        const cityType = document.getElementById('cityType').value;
        const deduction80c = Math.min(parseFloat(document.getElementById('deduction80c').value) || 0, 150000);
        const deduction80d = Math.min(parseFloat(document.getElementById('deduction80d').value) || 0, age === 'below60' ? 25000 : 50000);
        const deduction80e = parseFloat(document.getElementById('deduction80e').value) || 0;
        const deduction80g = parseFloat(document.getElementById('deduction80g').value) || 0;
        const deduction80tta = Math.min(parseFloat(document.getElementById('deduction80tta').value) || 0, 10000);
        const homeLoan = Math.min(parseFloat(document.getElementById('homeLoan').value) || 0, 200000);
        const nps = Math.min(parseFloat(document.getElementById('nps').value) || 0, 50000);

        const totalIncome = salary + otherIncome;
        const hraExemption = regime === 'old' ? calculateHRAExemption(salary, rent, hraReceived, cityType) : 0;
        const standardDeduction = regime === 'new' ? 75000 : 50000;
        const totalDeductions = regime === 'old' ? (hraExemption + deduction80c + deduction80d + deduction80e + deduction80g + deduction80tta + homeLoan + nps + standardDeduction) : standardDeduction;
        const taxableIncome = Math.max(0, totalIncome - totalDeductions);

        const oldTaxBase = calculateTaxForRegime('old', taxableIncome, age);
        const newTaxBase = calculateTaxForRegime('new', taxableIncome, age);
        const oldTaxDetails = applySurchargeAndCess(oldTaxBase, taxableIncome);
        const newTaxDetails = applySurchargeAndCess(newTaxBase, taxableIncome);
        const selectedTaxDetails = regime === 'old' ? oldTaxDetails : newTaxDetails;

        document.getElementById('totalIncome').textContent = totalIncome.toLocaleString('en-IN');
        document.getElementById('hraExemption').textContent = hraExemption.toLocaleString('en-IN');
        document.getElementById('totalDeductions').textContent = totalDeductions.toLocaleString('en-IN');
        document.getElementById('taxableIncome').textContent = taxableIncome.toLocaleString('en-IN');
        document.getElementById('taxBeforeSurcharge').textContent = selectedTaxDetails.tax.toLocaleString('en-IN');
        document.getElementById('surcharge').textContent = selectedTaxDetails.surcharge.toLocaleString('en-IN');
        document.getElementById('cess').textContent = selectedTaxDetails.cess.toLocaleString('en-IN');
        document.getElementById('totalTax').textContent = selectedTaxDetails.total.toLocaleString('en-IN');
        document.getElementById('monthlyTax').textContent = (selectedTaxDetails.total / 12).toLocaleString('en-IN', { maximumFractionDigits: 2 });
        document.getElementById('oldRegimeTax').textContent = oldTaxDetails.total.toLocaleString('en-IN');
        document.getElementById('newRegimeTax').textContent = newTaxDetails.total.toLocaleString('en-IN');

        const recommendedRegime = oldTaxDetails.total < newTaxDetails.total ? 'Old' : 'New';
        document.getElementById('recommendedRegime').textContent = `${recommendedRegime} (Saves ₹${Math.abs(oldTaxDetails.total - newTaxDetails.total).toLocaleString('en-IN')})`;

        const insights = document.getElementById('insights');
        insights.innerHTML = '';
        insights.innerHTML += `<p><strong>Income Breakdown:</strong> Salary (₹${salary.toLocaleString('en-IN')}, ${(salary / totalIncome * 100).toFixed(2)}%), Other Income (₹${otherIncome.toLocaleString('en-IN')}, ${(otherIncome / totalIncome * 100).toFixed(2)}%).</p>`;
        if (regime === 'old' && hraExemption > 0) {
            insights.innerHTML += `<p><strong>HRA Exemption:</strong> ₹${hraExemption.toLocaleString('en-IN')} reduces taxable income due to rent paid (₹${rent.toLocaleString('en-IN')}) and HRA received (₹${hraReceived.toLocaleString('en-IN')}).</p>`;
        }
        insights.innerHTML += `<p><strong>Deductions Utilized:</strong> ₹${totalDeductions.toLocaleString('en-IN')} - Standard Deduction: ₹${standardDeduction.toLocaleString('en-IN')}${regime === 'old' ? `, 80C: ₹${deduction80c.toLocaleString('en-IN')}, 80D: ₹${deduction80d.toLocaleString('en-IN')}, 80E: ₹${deduction80e.toLocaleString('en-IN')}, 80G: ₹${deduction80g.toLocaleString('en-IN')}, 80TTA: ₹${deduction80tta.toLocaleString('en-IN')}, Home Loan: ₹${homeLoan.toLocaleString('en-IN')}, NPS: ₹${nps.toLocaleString('en-IN')}` : ''}.</p>`;
        const slabBreakdown = calculateSlabBreakdown(regime, taxableIncome, age);
        if (slabBreakdown.length > 0) {
            insights.innerHTML += `<p><strong>Tax Slab Breakdown (${regime === 'old' ? 'Old' : 'New'} Regime):</strong> ${slabBreakdown.map(s => `${s.slab} @ ${s.rate} = ₹${s.amount.toLocaleString('en-IN')}`).join(', ')}.</p>`;
        }
        insights.innerHTML += `<p><strong>Regime Comparison:</strong> Old Regime tax: ₹${oldTaxDetails.total.toLocaleString('en-IN')}, New Regime tax: ₹${newTaxDetails.total.toLocaleString('en-IN')}. ${recommendedRegime} regime is optimal, saving ₹${Math.abs(oldTaxDetails.total - newTaxDetails.total).toLocaleString('en-IN')}.</p>`;

        const investmentPlan = document.getElementById('investmentPlan');
        investmentPlan.innerHTML = '';
        if (regime === 'old') {
            if (deduction80c < 150000) {
                const savings80c = Math.min(150000 - deduction80c, taxableIncome) * (taxableIncome > 1000000 ? 0.30 : taxableIncome > 500000 ? 0.20 : 0.05);
                investmentPlan.innerHTML += `<li>Section 80C: Invest ₹${(150000 - deduction80c).toLocaleString('en-IN')} more to save ₹${savings80c.toLocaleString('en-IN')} (ELSS/PPF).</li>`;
            }
            if (deduction80d < (age === 'below60' ? 25000 : 50000)) {
                const max80d = age === 'below60' ? 25000 : 50000;
                const savings80d = Math.min(max80d - deduction80d, taxableIncome) * (taxableIncome > 1000000 ? 0.30 : taxableIncome > 500000 ? 0.20 : 0.05);
                investmentPlan.innerHTML += `<li>Section 80D: Invest ₹${(max80d - deduction80d).toLocaleString('en-IN')} more to save ₹${savings80d.toLocaleString('en-IN')} (Health Insurance).</li>`;
            }
            if (deduction80tta < 10000 && age === 'below60') {
                const savings80tta = Math.min(10000 - deduction80tta, taxableIncome) * (taxableIncome > 1000000 ? 0.30 : taxableIncome > 500000 ? 0.20 : 0.05);
                investmentPlan.innerHTML += `<li>Section 80TTA: Claim ₹${(10000 - deduction80tta).toLocaleString('en-IN')} more to save ₹${savings80tta.toLocaleString('en-IN')} (Savings Interest).</li>`;
            }
            if (nps < 50000) {
                const savingsNps = Math.min(50000 - nps, taxableIncome) * (taxableIncome > 1000000 ? 0.30 : taxableIncome > 500000 ? 0.20 : 0.05);
                investmentPlan.innerHTML += `<li>Section 80CCD(1B): Contribute ₹${(50000 - nps).toLocaleString('en-IN')} more to NPS to save ₹${savingsNps.toLocaleString('en-IN')}.</li>`;
            }
            if (homeLoan < 200000) {
                const savingsHomeLoan = Math.min(200000 - homeLoan, taxableIncome) * (taxableIncome > 1000000 ? 0.30 : taxableIncome > 500000 ? 0.20 : 0.05);
                investmentPlan.innerHTML += `<li>Home Loan Interest: Claim ₹${(200000 - homeLoan).toLocaleString('en-IN')} more to save ₹${savingsHomeLoan.toLocaleString('en-IN')}.</li>`;
            }
        }

        if (taxChart) taxChart.destroy();
        taxChart = new Chart(document.getElementById('taxChart'), {
            type: 'bar',
            data: {
                labels: ['Old Regime', 'New Regime'],
                datasets: [{
                    label: 'Tax Payable (₹)',
                    data: [oldTaxDetails.total, newTaxDetails.total],
                    backgroundColor: ['#FF6B35', '#4CAF50']
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        const yearlyData = [];
        let currentIncome = totalIncome;
        for (let i = 0; i < 5; i++) {
            const yearTaxable = Math.max(0, currentIncome - totalDeductions);
            const yearOldTax = applySurchargeAndCess(calculateTaxForRegime('old', yearTaxable, age), yearTaxable).total;
            const yearNewTax = applySurchargeAndCess(calculateTaxForRegime('new', yearTaxable, age), yearTaxable).total;
            yearlyData.push({ year: 2025 + i, old: yearOldTax, new: yearNewTax });
            currentIncome *= 1.05;
        }

        if (yearlyChart) yearlyChart.destroy();
        yearlyChart = new Chart(document.getElementById('yearlyChart'), {
            type: 'line',
            data: {
                labels: yearlyData.map(d => d.year),
                datasets: [
                    { label: 'Old Regime', data: yearlyData.map(d => d.old), borderColor: '#FF6B35', fill: false },
                    { label: 'New Regime', data: yearlyData.map(d => d.new), borderColor: '#4CAF50', fill: false }
                ]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
        localStorage.setItem('taxPlannerData', JSON.stringify({ totalIncome, totalDeductions, taxableIncome, totalTax, regime }));
    }

    function exportToPDF() {
        const element = document.getElementById('resultSection');
        html2pdf()
            .from(element)
            .set({
                margin: 1,
                filename: 'Tax_Planner_FY_2024-25_2025-26.pdf',
                html2canvas: { scale: 2 },
                jsPDF: { orientation: 'portrait', unit: 'in', format: 'letter' }
            })
            .save();
    }
</script>
</body>
</html>