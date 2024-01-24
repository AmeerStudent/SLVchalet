package com.heroku.java.MODEL;
public class room extends facility {
	
	private String roomCategory;
	public room(){
		
	}

	public room(String facilityId, String facilityStatus, double facilityPrice, String facilityName, int facilityQtty, String facilityDescription, String facilityType, byte[] facilityPic, String roomCategory, String staffId){
        super(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
        this.roomCategory = roomCategory;
    }
	
	public String getRoomCategory() {
		return roomCategory;
	}

	public void setRoomCategory(String roomCategory) {
		this.roomCategory = roomCategory;
	}
	
	
}
