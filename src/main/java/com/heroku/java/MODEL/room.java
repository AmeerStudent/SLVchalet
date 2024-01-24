package com.heroku.java.MODEL;
public class room extends facility {
	private String facilityId;
	private String roomCategory;
	public room(){
		
	}
	public String getFacilityId() {
		return facilityId;
	}

	public void setFacilityId(String facilityId) {
		this.facilityId = facilityId;
	}

	public String getRoomCategory() {
		return roomCategory;
	}

	public void setRoomCategory(String roomCategory) {
		this.roomCategory = roomCategory;
	}
	
	
}
