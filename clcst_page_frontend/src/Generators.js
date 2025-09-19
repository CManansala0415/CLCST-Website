// QR + PDF utils

const qrImageGenerator = async (data, filename = 'qr.png') => {
  if (!data || typeof data !== 'string' || data.trim() === '') {
    throw new Error('Missing source element or string for QR generation.');
  }

  const typeNumber = 4;
  const errorCorrectionLevel = 'L';
  const qr = qrcode(typeNumber, errorCorrectionLevel);
  qr.addData(data);
  qr.make();

  const img = document.createElement('img');
  img.src = qr.createDataURL();
  await new Promise(resolve => { img.onload = resolve; });

  const canvas = document.createElement('canvas');
  canvas.width = img.width;
  canvas.height = img.height;
  const ctx = canvas.getContext('2d');
  ctx.drawImage(img, 0, 0);

  const dataUrl = canvas.toDataURL('image/png');

  const link = document.createElement('a');
  link.href = dataUrl;
  link.download = filename;
  link.click();

  return dataUrl;
};



// ✅ Generates a PDF from the #printform element
const pdfGenerator = async (name, paper, orientation, margin) => {
  const element = document.getElementById('printform');
  if (!element) throw new Error('printform element not found');

  const opt = {
    margin: margin,
    filename: name + '.pdf',
    pagebreak: { mode: 'css', before: '.pagebreak' },
    image: { type: 'jpeg', quality: 1 },
    html2canvas: {
      dpi: 192,
      scale: 4,
      letterRendering: true,
      useCORS: true,
      scrollY: 0
    },
    jsPDF: {
      unit: 'in',
      format: paper,
      orientation: orientation
    },
  };

  return html2pdf().set(opt).from(element).save();
};

export {
  qrImageGenerator,
  pdfGenerator,
};
