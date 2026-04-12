<x-mylayouts.layout-default>


<div class="receipt-content">
    <div class="container bootstrap snippets bootdey my-5">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">
					<div class="intro">
						Hi <strong>{{ $user->name }}</strong>,
						<br>
						This is the receipt for a payment of <strong>${{ \App\Helpers\CustomHelper::formatPrice($order->total) }}</strong> (TTD) at Plant Hub TT.
					</div>

					<div class="payment-info">
						<div class="row">
							<div class="col-sm-6">
								<span>Invoice No.</span>
								<strong>#{{ $order->order_no }}</strong>
							</div>
							<div class="col-sm-6 text-right">
								<span>Payment Date</span>
								<strong>{{ \App\Helpers\CustomHelper::formatDateToReadable($order->created_at) }}</strong>
							</div>
						</div>
					</div>

					<div class="payment-details">
						<div class="row">
							<div class="col-sm-6">
								<span>Customer Information</span>
                                <br>
								<strong>
                                    {{ $user->name }}
                                </strong>
								<p>
									{{ $address-> contact }} <br>
								</p>
							</div>
							<div class="col-sm-6 text-right">
								<span>Payment To</span>
								<strong>
									Plant Hub TT
								</strong>
								<p>
									123 Sam Street <br>
									San Fernando <br>
									Trinidad and Tobago <br>
									<a href="#">
										ryan@planthubtt.com
									</a>
								</p>
							</div>
						</div>
					</div>

					<div class="line-items">
                        <div class="headers clearfix">
                             <div class="row">
                            <div class="col-md-4"><strong>Description</strong></div>
                            <div class="col-md-4 text-center"><strong>Quantity</strong></div>
                            <div class="col-md-4 text-right"><strong>Amount</strong></div>
                            </div>
                        </div>
                    </div>


                        <div class="items">
                            @foreach ($product_data as $product)
                                    <div class="row item">
                                        <div class="col-md-4 desc">
                                            {{ $product->title }}
                                            </div>
                                            <div class="col-md-4 text-center">
                                                {{ $product->pivot->quantity }}
                                            </div>
                                        <div class="col-md-4 text-right">
                                            ${{ \App\Helpers\CustomHelper::formatPrice($product->pivot->price*$product->pivot->quantity) }}
                                    </div>
                                </div>
                             @endforeach
                        </div>

                            <div class="total text-right">
							<div class="field">
								Subtotal <span>${{ \App\Helpers\CustomHelper::formatPrice($order->subtotal) }}</span>
							</div>
							@php
    $shipping = $order->shipping;
@endphp

<div class="field">
    Shipping <span>${{ \App\Helpers\CustomHelper::formatPrice($shipping->price ?? 0) }}</span>
</div>
							<div class="field">
								Discount <span>0%</span>
							</div>
							<div class="field grand-total">
								Total <span>${{ \App\Helpers\CustomHelper::formatPrice($order->total) }}</span>
							</div>
						</div>

						<div class="print">
							<a href="#">
								<i class="fa fa-print"></i>
								Print this receipt
							</a>
						</div>
					</div>
				</div>

				<div class="footer">
					Copyright © 2014. Plant Hub TT
				</div>
			</div>
		</div>
	</div>
</div>


</x-mylayouts.layout-default>
