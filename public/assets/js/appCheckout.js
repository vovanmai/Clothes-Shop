window.addEventListener("DOMContentLoaded", function(events)
{
	let submit = document.getElementById('submit-checkout');
	let success = document.getElementById('success');
	submit.addEventListener('click', function(event)
	{
		success.style.display = 'block';
	});
});