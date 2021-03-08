<?php
	include('include/header.php')
?>

<section>
	<div class="container">
		<div class="bill-con">
			<div class="row">
			<div class="col-md-7 col-sm-12">
				<div class="bil-form">
					<h2>Billing Information</h2>
					<form>
						<input type="text" name="id" placeholder="Order ID">
						<input type="text" name="name"placeholder="Name">
						<input type="email" name="email"placeholder="Email ID">
						<input type="number" name="number"placeholder="Number">
						<input type="text" name="location"placeholder="Location">
					</form>
				</div>
			</div>
			<div class="col-md-5 col-sm-12">
				<div class="bill-info">
					<FORM id="bil-info" name="drop_list" action="" method="POST" >
					   <div class="row">
					      <div class="col-md-4">
					         <div class="img-box">
					            <img src="images/gallery-img-01.jpg">
					         </div>
					      </div>
					      <div class="col-md-4">
					         <div class="detail">
					            <h4>langhosh1</h4>
					            <p>with veg1</p>
					            <div class="input-group">
					               <input type="button" value="-" class="button-minus" data-field="quantity">
					               <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field">
					               <input type="button" value="+" class="button-plus" data-field="quantity">
					            </div>
					         </div>
					      </div>
					      <div class="col-md-4">
					         <div class="prize-1">
					            <div class="bottom">
					               <h4>$8</h4>
					            </div>
					         </div>
					      </div>
					   </div>
					   <hr>
					   <div class="row">
					      <div class="col-6">
					         <div class="sub-total">
					            <h4>Sub Total</h4>
					         </div>
					      </div>
					      <div class="col-6">
					         <div class="total">
					            <h4>&8</h4>
					         </div>
					      </div>
					   </div>
					   <div class="col-12">
					      <div class="remarks">
					         <textarea rows="1" placeholder="Remarks" ></textarea>
					      </div>
					   </div>
					   <div class="col-12">
					      <div class="text-center">
					         <button type="button" class="btn continue-btn">Continue</button>
					      </div>
					   </div>
					</form>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>

<?php
	include('include/footer.php')
?>