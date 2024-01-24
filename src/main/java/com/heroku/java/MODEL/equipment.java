package com.heroku.java.MODEL;
public class equipment {
	
	private String equipType;
	public equipment(){
	}

	public equipment(String facilityId, String facilityStatus, double facilityPrice, String facilityName, int facilityQtty, String facilityDescription, String facilityType, byte[] facilityPic, , String staffId, String equipType){
        super(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
        this.equipType = equipType;
    }
	public String getFacilityId() {
		return facilityId;
	}

	public void setFacilityId(String facilityId) {
		this.facilityId = facilityId;
	}


	public String getEquipType() {
		return equipType;
	}

	public void setEquipType(String equipType) {
		this.equipType = equipType;
	}

}
