package com.heroku.java.MODEL;
public class reservation {
	private String reserveId;
	private String reserveCheckIn;
	private String reserveCheckOut;
	private String reserveStatus;
	private String paymentStatus;
	private String receipt;

	public reservation() {

	}

	public String getReserveId() {
		return reserveId;
	}

	public void setReserveId(String reserveId) {
		this.reserveId = reserveId;
	}

	

	public String getReserveCheckIn() {
		return reserveCheckIn;
	}

	public void setReserveCheckIn(String reserveCheckIn) {
		this.reserveCheckIn = reserveCheckIn;
	}

	public String getReserveCheckOut() {
		return reserveCheckOut;
	}

	public void setReserveCheckOut(String reserveCheckOut) {
		this.reserveCheckOut = reserveCheckOut;
	}

	public String getReserveStatus() {
		return reserveStatus;
	}

	public void setReserveStatus(String reserveStatus) {
		this.reserveStatus = reserveStatus;
	}

	public String getPaymentStatus() {
		return paymentStatus;
	}

	public void setPaymentStatus(String paymentStatus) {
		this.paymentStatus = paymentStatus;
	}

	public String getReceipt() {
		return receipt;
	}

	public void setReceipt(String receipt) {
		this.receipt = receipt;
	}

}
