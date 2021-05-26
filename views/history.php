<?php
$i = 1;
?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<table class="table col-6">
			<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Amount</th>
				<th scope="col">From</th>
				<th scope="col">To</th>
				<th scope="col">Result</th>
				<th scope="col">Date</th>
			</tr>
			</thead>
			<tbody>
			<?
			foreach ($history as $row){?>
			<tr>
				<td><?=$i?></td>
				<td><?=$row['amount']?></td>
				<td><?=$row['from_currency']?></td>
				<td><?=$row['to_currency']?></td>
				<td><?=$row['result']?></td>
				<td><?=$row['date']?></td>
			</tr>
			<? $i++;
			}?>
			</tbody>
		</table>
	</div>
</div>
