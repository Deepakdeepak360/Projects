import sys
import pandas as pd
import json
from xgboost import XGBRegressor
from datetime import timedelta

product_name = sys.argv[1]
file_path = sys.argv[2]

try:
    df = pd.read_csv(file_path)
    df['date'] = pd.to_datetime(df['date'])
    df = df.sort_values('date')

    # Features
    df['prev_day_sales'] = df['sales'].shift(1).bfill()
    df['day_of_week'] = df['date'].dt.dayofweek
    df['month'] = df['date'].dt.month
    df['rolling_3'] = df['sales'].rolling(window=3).mean().bfill()

    X = df[['prev_day_sales', 'day_of_week', 'month', 'rolling_3']]
    y = df['sales']

    model = XGBRegressor()
    model.fit(X, y)

    # Predict next 30 days
    last_date = df['date'].max()
    last_sales = df.iloc[-1]['sales']
    rolling_window = list(df['sales'].tail(3))

    predictions = []
    for i in range(30):
        pred_date = last_date + timedelta(days=i + 1)
        dow = pred_date.weekday()
        mon = pred_date.month
        rolling_avg = sum(rolling_window[-3:]) / 3
        features = [[last_sales, dow, mon, rolling_avg]]
        pred = model.predict(features)[0]

        predictions.append({
            "date": pred_date.strftime('%Y-%m-%d'),
            "predicted_sales": float(pred)
        })

        last_sales = pred
        rolling_window.append(pred)

    # ✅ Save to CSV
    output_df = pd.DataFrame(predictions)
    output_df.to_csv("downloads/predicted_output.csv", index=False)

    # ✅ Return as JSON
    print(json.dumps(predictions))

except Exception as e:
    print(json.dumps({"error": str(e)}))
