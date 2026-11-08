from flask import Flask, render_template, request, redirect, url_for
import os
from werkzeug.utils import secure_filename
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import load_img, img_to_array
import numpy as np

app = Flask(__name__)

# Configure paths
UPLOAD_FOLDER = 'static/uploads'
MODEL_PATH = 'image_classification_model_2.h5'
LABELS = ['cardboard', 'glass', 'metal', 'paper', 'plastic', 'trash']  # Urutan label

app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

# Load Keras model
model = load_model(MODEL_PATH)

# Ensure upload folder exists
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

@app.route('/')
def upload_file():
    return render_template('upload.html')

@app.route('/predict', methods=['POST'])
def predict():
    if 'file' not in request.files:
        return redirect(request.url)

    file = request.files['file']
    if file.filename == '':
        return redirect(request.url)

    if file:
        # Save uploaded file
        filename = secure_filename(file.filename)
        upload_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(upload_path)

        try:
            # Preprocess image
            image = load_img(upload_path, target_size=(224, 224))  # Sesuaikan ukuran
            image_array = img_to_array(image) / 255.0  # Normalisasi
            image_array = np.expand_dims(image_array, axis=0)  # Tambahkan dimensi batch

            # Predict
            prediction = model.predict(image_array)
            predicted_class_idx = np.argmax(prediction)  # Indeks prediksi
            predicted_label = LABELS[predicted_class_idx]  # Konversi ke label
            confidence = np.max(prediction)  # Nilai confidence tertinggi

            # Format confidence sebagai persentase
            confidence_percent = f"{confidence * 100:.2f}%"

            return render_template(
                'result.html',
                uploaded_image=upload_path,
                predicted_label=predicted_label,
                confidence=confidence_percent
            )
        except Exception as e:
            return f"Error processing image: {str(e)}"

if __name__ == '__main__':
    app.run(debug=True)
