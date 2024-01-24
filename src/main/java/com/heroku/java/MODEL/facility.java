package com.heroku.java.MODEL;
public class facility {
	
	 private String facilityStatus;
	 private Double facilityPrice;
	 private String facilityName;
	 private String facilityDescription;
	 private String facilityId;
	 private int facilityQtty;
     private String facilityType;
     private byte[] facilityPic;
	 private String staffId;
	 public facility (){
		 
	 }
	
	 public String getFacilityId() {
	  return facilityId;
	 }
	 public void setFacilityId(String facilityId) {
	  this.facilityId = facilityId;
	 }
	
	 public String getFacilityStatus() {
	  return facilityStatus;
	 }
	 public void setFacilityStatus(String facilityStatus) {
	  this.facilityStatus = facilityStatus;
	 }
	 public Double getFacilityPrice() {
	  return facilityPrice;
	 }
	 public void setFacilityPrice(Double facilityPrice) {
	  this.facilityPrice = facilityPrice;
	 }
	 public String getFacilityName() {
	  return facilityName;
	 }
	 public void setFacilityName(String facilityName) {
	  this.facilityName = facilityName;
	 }
	 public String getFacilityDescription() {
	  return facilityDescription;
	 }
	 public void setFacilityDescription(String facilityDescription) {
	  this.facilityDescription = facilityDescription;
	 }
	 public int getFacilityQtty() {
	  return facilityQtty;
	 }
	 public void setFacilityQtty(int facilityQtty) {
	  this.facilityQtty = facilityQtty;
	 }
	 public String getFacilityType() {
		return facilityType;
	}
	public void setFacilityType(String facilityType) {
		this.facilityType = facilityType;
	}
	public byte[] getFacilityPic() {
		return facilityPic;
	}
	public void setFacilityPic(byte[] facilityPic) {
		this.facilityPic = facilityPic;
	}
	 public String getStaffId() {
	  return staffId;
	 }
	 public void setStaffId(String staffId) {
	  this.staffId = staffId;
	 }
	}

