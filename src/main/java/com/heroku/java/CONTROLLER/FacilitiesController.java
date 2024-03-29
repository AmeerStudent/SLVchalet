package com.heroku.java.CONTROLLER;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import com.heroku.java.MODEL.*;
import com.heroku.java.MODEL.facility;
import com.heroku.java.MODEL.room;
import com.heroku.java.MODEL.equipment;

import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List; 

@Controller
public class FacilitiesController {
    private final DataSource dataSource;
    @Autowired
    public FacilitiesController(DataSource dataSource) {
        this.dataSource = dataSource;
    }
// add facility
    @GetMapping("/facilityregister")
    public String facilityregister() {
        return "facilityregister";
    }
// add facility
    @PostMapping("/facilityregister")
    public String facilityregister(Model model, @ModelAttribute("facilityregister") facility facility, room room, equipment equipment) {
        try {
            Connection connection = dataSource.getConnection();
            String sql = "INSERT INTO facilities(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId) VALUES (?,?,?,?,?,?,?,?,?)";
            final var statement = connection.prepareStatement(sql);

            String facilityId=facility.getFacilityId();
            String facilityStatus=facility.getFacilityStatus();
            double facilityPrice=facility.getFacilityPrice();
            String facilityName=facility.getFacilityName();
            int facilityQtty=facility.getFacilityQtty();
            String facilityDescription=facility.getFacilityDescription();
            String facilityType=facility.getFacilityType();
            byte[] facilityPic=facility.getFacilityPic();
            String staffId=facility.getStaffId();

            if (facilityType.equalsIgnoreCase("room")){
            facilityType = "Room";}
            else {
            facilityType = "Equipment";}

            
            statement.setString(1, facilityId);
            statement.setString(2, facilityStatus);
            statement.setDouble(3, facilityPrice);
            statement.setString(4, facilityName);
            statement.setInt(5, facilityQtty);
            statement.setString(6, facilityDescription);
            statement.setString(7, facilityType);
            statement.setBytes(8, facilityPic);
             statement.setString(9, staffId);

            statement.executeUpdate();

            // Get id from database for sql 2 from sql 1
            String sql1 = "SELECT facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId FROM public.facilities where facilityId=?";
            final var stmt = connection.prepareStatement(sql1);
            stmt.setString(1, facilityId);
            final var resultSet = stmt.executeQuery();

                // Update fields specific to "room" or "equipment" based on the facility type
                if (facilityType.equalsIgnoreCase("Room")) {
                    String roomSql = "INSERT INTO room(facilityId, roomCategory) VALUES (?, ?)";
                    final var roomStatement = connection.prepareStatement(roomSql);
                    roomStatement.setString(1, facilityId);
                    roomStatement.setString(2, room.getRoomCategory());

                    roomStatement.executeUpdate();
                } else if (facilityType.equalsIgnoreCase("Equipment")) {
                    String equipmentSql = "INSERT INTO equipment(facilityId, equipType) VALUES (?,?)";
                    final var equipmentStatement = connection.prepareStatement(equipmentSql);
                    equipmentStatement.setString(1, facilityId);
                    equipmentStatement.setString(2, equipment.getEquipType());

                    equipmentStatement.executeUpdate();
                }
                model.addAttribute("success", true);

            connection.close();
        } catch (SQLException e) {
            e.printStackTrace();
            return "redirect:/facilityregister?success=false";
        }

        return "redirect:/facilitylist?success=true";
    }
    // facility list
    @GetMapping("/facilitylist")
    public String facilitylist(Model model) {
        List<facility> facilitiess = new ArrayList<>();

        try {
            Connection connection = dataSource.getConnection();
            String sql = "SELECT facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId FROM facilities ORDER BY facilityId";
            final var statement = connection.createStatement();
            final var resultSet = statement.executeQuery(sql);

            while (resultSet.next()) {
                String facilityId = resultSet.getString("facilityId");
                String facilityStatus = resultSet.getString("facilityStatus");
                double facilityPrice = resultSet.getDouble("facilityPrice");
                String facilityName = resultSet.getString("facilityName");
                int facilityQtty = resultSet.getInt("facilityQtty");
                String facilityDescription = resultSet.getString("facilityDescription");
                String facilityType = resultSet.getString("facilityType");
                 byte[] facilityPic = resultSet.getBytes("facilityPic");
                String staffId = resultSet.getString("staffId");
                facility facility;
                if (facilityType.equalsIgnoreCase("room")) {
                    String roomSql = "SELECT facilityId, roomCategory FROM room WHERE facilityId=?";
                    final var roomStatement = connection.prepareStatement(roomSql);
                    roomStatement.setString(1, facilityId);
                    final var roomResultSet = roomStatement.executeQuery();
                    if (roomResultSet.next()) {
                        String roomCategory = roomResultSet.getString("roomCategory");
                        facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory, staffId);
                    } else {
                        facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
                    }
                } else if (facilityType.equalsIgnoreCase("equipment")) {
                    String equipmentSql = "SELECT facilityId, equipType FROM equipment WHERE facilityId=?";
                    final var equipmentStatement = connection.prepareStatement(equipmentSql);
                    equipmentStatement.setString(1, facilityId);
                    final var equipmentResultSet = equipmentStatement.executeQuery();
                    if (equipmentResultSet.next()) {
                        String equipType = equipmentResultSet.getString("equipType");
                        facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType,staffId );
                    } else {
                        facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic,staffId);
                    }
                } else {
                    facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
                }

                facilitiess.add(facility);
            }

            model.addAttribute("facilitiess", facilitiess);

            connection.close();

        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "facilitylist";
    }

    // facility list untuk customer 
    @GetMapping("/reservationCust")
    public String reservationCust(Model model) {
        List<facility> facilitiess = new ArrayList<>();

        try {
            Connection connection = dataSource.getConnection();
            String sql = "SELECT facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId FROM facilities ORDER BY facilityId";
            final var statement = connection.createStatement();
            final var resultSet = statement.executeQuery(sql);

            while (resultSet.next()) {
                String facilityId = resultSet.getString("facilityId");
                String facilityStatus = resultSet.getString("facilityStatus");
                double facilityPrice = resultSet.getDouble("facilityPrice");
                String facilityName = resultSet.getString("facilityName");
                int facilityQtty = resultSet.getInt("facilityQtty");
                String facilityDescription = resultSet.getString("facilityDescription");
                String facilityType = resultSet.getString("facilityType");
                 byte[] facilityPic = resultSet.getBytes("facilityPic");
                String staffId = resultSet.getString("staffId");
                facility facility;
                if (facilityType.equalsIgnoreCase("room")) {
                    String roomSql = "SELECT facilityId, roomCategory FROM room WHERE facilityId=?";
                    final var roomStatement = connection.prepareStatement(roomSql);
                    roomStatement.setString(1, facilityId);
                    final var roomResultSet = roomStatement.executeQuery();
                    if (roomResultSet.next()) {
                        String roomCategory = roomResultSet.getString("roomCategory");
                        facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory, staffId);
                    } else {
                        facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
                    }
                } else if (facilityType.equalsIgnoreCase("equipment")) {
                    String equipmentSql = "SELECT facilityId, equipType FROM equipment WHERE facilityId=?";
                    final var equipmentStatement = connection.prepareStatement(equipmentSql);
                    equipmentStatement.setString(1, facilityId);
                    final var equipmentResultSet = equipmentStatement.executeQuery();
                    if (equipmentResultSet.next()) {
                        String equipType = equipmentResultSet.getString("equipType");
                        facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType,staffId );
                    } else {
                        facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic,staffId);
                    }
                } else {
                    facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
                }

                facilitiess.add(facility);
            }

            model.addAttribute("facilitiess", facilitiess);

            connection.close();

        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "reservationCust";
    }

    // view facilities
    @GetMapping("/facilityview")
    public String facilityview(@RequestParam("facilityId") String facilityId, Model model) {
        System.out.println("Facility ID : " + facilityId);
        try {
            Connection connection = dataSource.getConnection();

            String sql = "SELECT facilities.facilityId, facilities.facilityStatus, facilities.facilityPrice, facilities.facilityName, facilities.facilityQtty, facilities.facilityDescription, facilities.facilityType, facilities.facilityPic, facilities.staffId, room.roomCategory, equipment.equipType "
            + "FROM facilities "
            + "LEFT JOIN room ON facilities.facilityId = room.facilityId "
            + "LEFT JOIN equipment ON equipment.facilityId = facilities.facilityId "
            + "WHERE facilities.facilityId = ?";

            final var statement = connection.prepareStatement(sql);
            statement.setString(1, facilityId);
            final var resultSet = statement.executeQuery();

            if (resultSet.next()) {
                
                String facilityStatus = resultSet.getString("facilityStatus");
                double facilityPrice = resultSet.getDouble("facilityPrice");
                String facilityName = resultSet.getString("facilityName");
                int facilityQtty = resultSet.getInt("facilityQtty");
                String facilityDescription = resultSet.getString("facilityDescription");
                String facilityType = resultSet.getString("facilityType");
                byte[] facilityPic = resultSet.getBytes("facilityPic");
                   String staffId = resultSet.getString("staffId");

                facility facility;
                if (facilityType.equalsIgnoreCase("Room")) {
                    String roomCategory = resultSet.getString("roomCategory");
                    facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory, staffId);
                } else if (facilityType.equalsIgnoreCase("Equipment")) {
                    String equipType = resultSet.getString("equipType");
                    facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType, staffId );
                } else {
                    // Handle the case when serviceType is neither "room" nor "equipment"
                    facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
                }

                model.addAttribute("facility", facility); // Use "facility" as the model attribute name

                connection.close();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "facilityview";
    }

    // // get and post mapping for update facility
     @GetMapping("/facilityedit")
    public String facilityedit(@RequestParam("facilityId") String facilityId, Model model) {
        try {
            System.out.println("facility id from parameter: " + facilityId);
            Connection connection = dataSource.getConnection();
            String sql = "SELECT facilities.facilityId, facilities.facilityStatus, facilities.facilityPrice, facilities.facilityName, facilities.facilityQtty, facilities.facilityDescription, facilities.facilityType, facilities.facilityPic,  facilities.staffId, room.roomCategory, equipment.equipType "
            + "FROM facilities "
            + "LEFT JOIN room ON facilities.facilityId = room.facilityId "
            + "LEFT JOIN equipment ON equipment.facilityId = facilities.facilityId "
            + "WHERE facilities.facilityId = ?";

            final var statement = connection.prepareStatement(sql);
            statement.setString(1, facilityId);
            final var resultSet = statement.executeQuery();

            if (resultSet.next()) {
               
                String facilityStatus = resultSet.getString("facilityStatus");
                double facilityPrice = resultSet.getDouble("facilityPrice");
                String facilityName = resultSet.getString("facilityName");
                int facilityQtty = resultSet.getInt("facilityQtty");
                String facilityDescription = resultSet.getString("facilityDescription");
                String facilityType = resultSet.getString("facilityType");
                byte[] facilityPic = resultSet.getBytes("facilityPic");
                  String staffId = resultSet.getString("staffId");

                facility facility;
                if (facilityType.equalsIgnoreCase("Room")) {
                    String roomCategory = resultSet.getString("roomCategory");
                    facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory, staffId);
                } else if (facilityType.equalsIgnoreCase("Equipment")) {
                    String equipType = resultSet.getString("equipType");
                    facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType, staffId );
                } else {
                    // Handle the case when facilityType is neither "room" nor "equipment"
                    facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
                }

                model.addAttribute("facility", facility); // Use "facility" as the model attribute name

                connection.close();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "facilityedit";
    }

    @PostMapping("/facilityedit")
    public String facilityedit(@ModelAttribute("facilityedit")  facility facility, room room, equipment equipment) {
        try {
            Connection connection = dataSource.getConnection();
            String sql = "UPDATE facilities SET facilityStatus=?, facilityPrice=?, facilityName=?, facilityQtty=?, facilityDescription=?, facilityType=?, facilityPic=?, staffId=? WHERE facilityId=?";
            final var statement = connection.prepareStatement(sql);

            
            String facilityStatus = facility.getFacilityStatus();
            double facilityPrice = facility.getFacilityPrice();
            String facilityName = facility.getFacilityName();
            int facilityQtty = facility.getFacilityQtty();
            String facilityDescription = facility.getFacilityDescription();
            String facilityType = facility.getFacilityType();
            byte[] facilityPic = facility.getFacilityPic();
            String staffId = facility.getStaffId();
            String facilityId = facility.getFacilityId();

            if (facilityType.equalsIgnoreCase("room")){
            facilityType = "Room";}
            else {
            facilityType = "Equipment";}

            
            
            statement.setString(1, facilityStatus);
            statement.setDouble(2, facilityPrice);
            statement.setString(3, facilityName);
            statement.setInt(4, facilityQtty);
            statement.setString(5, facilityDescription);
            statement.setString(6, facilityType);
            statement.setBytes(7, facilityPic);
            statement.setString(8, staffId);
            statement.setString(9, facilityId);

            statement.executeUpdate();

            // Update fields specific to "room" or "equipment" based on the facility type
            if ("Room".equalsIgnoreCase(facility.getFacilityType())) {
                String roomSql = "UPDATE room SET roomCategory=? WHERE facilityId=?";
                final var roomStatement = connection.prepareStatement(roomSql);
                roomStatement.setString(1, room.getRoomCategory());
                roomStatement.setString(2, facility.getFacilityId());

                roomStatement.executeUpdate();
            } else if ("Equipment".equalsIgnoreCase(facility.getFacilityType())) {
                String equipmentSql = "UPDATE equipment SET equipType=? WHERE facilityId=?";
                final var equipmentStatement = connection.prepareStatement(equipmentSql);
                equipmentStatement.setString(1, equipment.getEquipType());
                equipmentStatement.setString(2, facility.getFacilityId());

                equipmentStatement.executeUpdate();
            }
             System.out.println("debug= " + facilityId + " " + facilityName);
            connection.close();

        } catch (Throwable t) {
            System.out.println("message : " + t.getMessage());
            System.out.println("error");
        }
        return  "redirect:/facilitylist";
    }


    //   @GetMapping("/custFacilityList")
    // public String custFacilityList(Model model) {
    //     List<facility> facilitiess = new ArrayList<>();

    //     try {
    //         Connection connection = dataSource.getConnection();
    //         String sql = "SELECT facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId FROM facilities ORDER BY facilityName";
    //         final var statement = connection.createStatement();
    //         final var resultSet = statement.executeQuery(sql);

    //         while (resultSet.next()) {
    //             String facilityId = resultSet.getString("facilityId");
    //             String facilityStatus = resultSet.getString("facilityStatus");
    //             double facilityPrice = resultSet.getDouble("facilityPrice");
    //             String facilityName = resultSet.getString("facilityName");
    //             int facilityQtty = resultSet.getInt("facilityQtty");
    //             String facilityDescription = resultSet.getString("facilityDescription");
    //             String facilityType = resultSet.getString("facilityType");
    //              byte[] facilityPic = resultSet.getBytes("facilityPic");
    //             String staffId = resultSet.getString("staffId");
    //             facility facility;
    //             if (facilityType.equalsIgnoreCase("room")) {
    //                 String roomSql = "SELECT facilityId, roomCategory FROM room WHERE facilityId=?";
    //                 final var roomStatement = connection.prepareStatement(roomSql);
    //                 roomStatement.setString(1, facilityId);
    //                 final var roomResultSet = roomStatement.executeQuery();
    //                 if (roomResultSet.next()) {
    //                     String roomCategory = roomResultSet.getString("roomCategory");
    //                     facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory, staffId);
    //                 } else {
    //                     facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
    //                 }
    //             } else if (facilityType.equalsIgnoreCase("equipment")) {
    //                 String equipmentSql = "SELECT facilityId, equipType FROM equipment WHERE facilityId=?";
    //                 final var equipmentStatement = connection.prepareStatement(equipmentSql);
    //                 equipmentStatement.setString(1, facilityId);
    //                 final var equipmentResultSet = equipmentStatement.executeQuery();
    //                 if (equipmentResultSet.next()) {
    //                     String equipType = equipmentResultSet.getString("equipType");
    //                     facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType,staffId );
    //                 } else {
    //                     facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic,staffId);
    //                 }
    //             } else {
    //                 facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId);
    //             }

    //             facilitiess.add(facility);
    //         }

    //         model.addAttribute("facilitiess", facilitiess);

    //         connection.close();

    //     } catch (SQLException e) {
    //         e.printStackTrace();
    //     }

    //     return "custFacilityList";
    // }
    
    @GetMapping("/deletefacility")
    public String deletefacility(String facilityId) {
        
        
            try (Connection connection = dataSource.getConnection()){
                
                String sql = "DELETE FROM facilities WHERE facilityId = ?";
                PreparedStatement statement = connection.prepareStatement(sql);
                statement.setString(1, facilityId);
                int rowsAffected = statement.executeUpdate();
                //statement.executeUpdate();
                if (rowsAffected > 0) {
                    // Deletion successful
                    connection.close();
                    return "redirect:/facilitylist"; 
                    // Redirect back to the facility list
                } else {
                    // Deletion failed
                    connection.close();
                    return "redirect:/facilitylist";
                    // Redirect to an error page or show an error message
                }


            } catch (SQLException e) {
                e.printStackTrace();
                // Handle the exception as desired (e.g., show an error message)
                // Redirect to an error page or show an error message
                return "facilitylist";
            }
        

        
    }

}
