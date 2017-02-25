/**
 * Notification
 * @param  {string} content notification content
 * @param  {string} color   notification color: green,red,yellow or blue
 */
function notification(content, color)
{
	document.getElementById('alert').innerHTML = '<div class="alert '+color+'">'+content+'</div>';
}

function myFunction(id)
{
	document.getElementById("myDropdown"+id).classList.toggle("show");
}

window.onclick = function(event)
{
	if (!event.target.matches('.dropbtn'))
	{
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++)
		{
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show'))
			{
				openDropdown.classList.remove('show');
			}
		}
	}
}