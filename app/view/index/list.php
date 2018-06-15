<table>
	<tr>
		<th>Place Name</th>
		<th>Country</th>
		<th>Longitude</th>
		<th>Latitude</th>
	</tr>
	<?php foreach($places as $place):?>
		<tr>
			<td><?=$place['name']?></td>
			<td><?=$country?></td>
			<td><?=$place['longitude']?></td>
			<td><?=$place['latitude']?></td>
		</tr>
	<?php endforeach;?>
</table>
