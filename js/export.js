// export to xslx
function ExportToXLSX(type, fn, dl){
	var table = document.getElementById('table');
	var wb = XLSX.utils.table_to_book(table, { sheet: 'sheet1' });
	return dl
		? XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' })
		: XLSX.writeFile(wb, fn || 'تقارير.' + (type || 'xls'));
}
// export to pdf
function ExportToPDF() {
	var table = document.getElementById('table');
	var opt = {
		margin: .5,
		filename: 'تقارير.pdf',
		image: { type: 'jpeg', quality: 0.98 },
		html2canvas: { scale: 2 },
		jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
	};
	pdf(table, opt);
}