package com.heroku.java.MODEL;
public class room extends facility {
	
	private String roomCategory;
	public room(){
		
	}

	room(String facilityId, String facilityStatus, double facilityPrice, String facilityName, int facilityQtty, String facilityDescription, String facilityType, byte[] facilityPic, String roomCategory, String staffId){
        super(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic);
        this.roomCategory = roomCategory;
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
