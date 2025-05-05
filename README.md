# AI Sales Predictor
This project is a web-based sales prediction application that uses machine learning to forecast future sales based on historical data. The application combines PHP, Python, and JavaScript to create an interactive and user-friendly experience.

## Features
- Upload CSV files containing historical sales data
- AI-powered sales prediction using XGBoost
- Interactive visualization with Chart.js
- 30-day sales forecast
- Downloadable prediction results
- Responsive web design

## Project Structure

Sales Prediction/
├── backend/
│   ├── downloads/         # Stores generated prediction files
│   ├── uploads/          # Stores uploaded CSV files
│   ├── predict.php       # PHP handler for file uploads
│   └── predict.py        # Python ML prediction script
└── index.html           # Main web interface

Trae

27 context(s) used

Workspace

readme.md

README.md 2-2

readme.md 1-4

predict.php 1-58

four_years_sales_data.csv 1-1464

... More ( 21 +)

# AI Sales Predictor
This project is a web-based sales prediction application that uses machine learning to forecast future sales based on historical data. The application combines PHP, Python, and JavaScript to create an interactive and user-friendly experience.

## Features
- Upload CSV files containing historical sales data
- AI-powered sales prediction using XGBoost
- Interactive visualization with Chart.js
- 30-day sales forecast
- Downloadable prediction results
- Responsive web design
## Project Structure
plaintext

Open Folder

1

2

3

4

5

6

7

Sales Prediction/

├── backend/

│   ├── downloads/         #

Stores generated prediction

files

│   ├── uploads/          #

Stores uploaded CSV files

│   ├── predict.php       #

PHP handler for file uploads

│   └── predict.py        #

Python ML prediction script

└── index.html           #

Main web interface

## Technologies Used
- Frontend:
  
  - HTML5
  - CSS3 (with animations and responsive design)
  - JavaScript
  - Chart.js for data visualization
- Backend:
  
  - PHP (7.0+) for server handling
  - Python for ML predictions
  - XGBoost for machine learning
  - Pandas for data processing
## Getting Started
1. Make sure you have the following installed:
   
   - PHP 7.0 or higher
   - Python 3.x
   - Required Python packages: pandas, xgboost

2. Install Python dependencies:
    pip install pandas xgboost

3. Start the PHP development server
    php -S 127.0.0.1:5500 -t .

4. Open your browser and visit your local host:
    http://127.0.0.1:5500 (in my case its local host 5500)

## Input Data Format
The application expects CSV files with the following format:

date,sales
2023-01-01,169
2023-01-02,188
...

## Features Details
1. Data Upload
   - Accepts CSV files with historical sales data
   - Validates file format and content

2. AI Prediction  
   - Uses XGBoost regression model
   - Features include:
     - Previous day sales
     - Day of week
     - Month
     - 3-day rolling average
     
3. Visualization
   - Interactive chart showing predicted values
   - Tabular display of predictions
   - Downloadable CSV results

## Notes
- The system provides 30-day sales forecasts
- Predictions are based on historical patterns
- The model considers seasonal trends and weekly patterns
- Results can be downloaded in CSV format for further analysis

## Security Features
- Input validation for file uploads
- Shell argument escaping
- Error handling and logging
- Secure file operations

This project demonstrates the integration of modern web technologies with machine learning to create a practical business intelligence tool.
