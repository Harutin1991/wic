<?php if(isset($message)): ?>
<?php foreach($message as $key=>$mes): ?>
<p class="<?php if($key == 'error'):?>error<?php else:?>success<?php endif;?>"><?=$mes?></p>
<?php endforeach;?>
<?php endif;?>
<form method="POST" onsubmit="return searchPlaces();">
	<div class="row">
		<div class="col-lg-6">
			<label for="zip_code">Zip : <input type="text" id="zip_code" class="form-control"></label>
		</div>
		<div class="col-lg-6">
			<label for="country">Country : 
				<select name="country" id="country">
					<?php foreach($countries as $country):?>
						<option value="<?=$country['abbreviation']?>"><?=$country['name']?></option>
					<?php endforeach;?>
				</select>
			</label>
		</div>
		<button type="submit">Search</button>
	</div>
</form>

<div id="places_list"></div>
