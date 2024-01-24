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
            String sql = "SELECT facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, staffId FROM facilities ORDER BY facilityName";
            final var statement = connection.createStatement();
            final var resultSet = statement.executeQuery(sql);

            while (resultSet.next()) {
                String facilityId = resultSet.getString("facilityId");
                String facilityStatus = resultSet.getString("facilityStatus");
                String facilityPrice = resultSet.getString("facilityPrice");
                String facilityName = resultSet.getString("facilityName");
                String facilityQtty = resultSet.getString("facilityQtty");
                String facilityDescription = resultSet.getString("facilityDescription");
                String facilityType = resultSet.getString("facilityType");
                String facilityPic = resultSet.getString("facilityPic");
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

    // // view facilities
    // @GetMapping("/view")
    // public String view(@RequestParam("facilityId") String facilityId, Model model) {
    //     try {
    //         Connection connection = dataSource.getConnection();

    //         String sql = "SELECT facility.facilityId, facility.facilityStatus, facility.facilityPrice, facility.facilityName, facility.facilityQtty, facility.facilityDescription, facility.facilityType, facility.facilityPic, room.roomCategory, equipment.equipType "
    //         + "FROM facility "
    //         + "LEFT JOIN room ON facility.facilityId = room.facilityId "
    //         + "LEFT JOIN equipment ON equipment.facilityId = facility.facilityId "
    //         + "WHERE facility.facilityId = ?";

    //         final var statement = connection.prepareStatement(sql);
    //         statement.setString(1, facilityId);
    //         final var resultSet = statement.executeQuery();

    //         if (resultSet.next()) {
    //             String facilityId = resultSet.getString("facilityId");
    //             String facilityStatus = resultSet.getString("facilityStatus");
    //             String facilityPrice = resultSet.getString("facilityPrice");
    //             String facilityName = resultSet.getString("facilityName");
    //             String facilityQtty = resultSet.getString("facilityQtty");
    //             String facilityDescription = resultSet.getString("facilityDescription");
    //             String facilityType = resultSet.getString("facilityType");
    //             String facilityPic = resultSet.getString("facilityPic");

    //             facility facility;
    //             if (facilityType.equalsIgnoreCase("Room")) {
    //                 String roomCategory = resultSet.getString("roomCategory");
    //                 facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory);
    //             } else if (facilityType.equalsIgnoreCase("Equipment")) {
    //                 String equipType = equipmentResultSet.getString("equipType");
    //                 facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType );
    //             } else {
    //                 // Handle the case when serviceType is neither "room" nor "equipment"
    //                 facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic);
    //             }

    //             model.addAttribute("facility", facility); // Use "facility" as the model attribute name

    //             connection.close();
    //         }
    //     } catch (SQLException e) {
    //         e.printStackTrace();
    //     }

    //     return "view";
    // }

    // // get and post mapping for update facility
    //  @GetMapping("/productadmin")
    // public String productadmin(@RequestParam("facilityId") String facilityId, Model model) {
    //     try {
    //         Connection connection = dataSource.getConnection();
    //         String sql = "SELECT facility.facilityId, facility.facilityStatus, facility.facilityPrice, facility.facilityName, facility.facilityQtty, facility.facilityDescription, facility.facilityType, facility.facilityPic, room.roomCategory, equipment.equipType "
    //         + "FROM facility "
    //         + "LEFT JOIN room ON facility.facilityId = room.facilityId "
    //         + "LEFT JOIN equipment ON equipment.facilityId = facility.facilityId "
    //         + "WHERE facility.facilityId = ?";

    //         final var statement = connection.prepareStatement(sql);
    //         statement.setString(1, facilityId);
    //         final var resultSet = statement.executeQuery();

    //         if (resultSet.next()) {
    //             String facilityId = resultSet.getString("facilityId");
    //             String facilityStatus = resultSet.getString("facilityStatus");
    //             String facilityPrice = resultSet.getString("facilityPrice");
    //             String facilityName = resultSet.getString("facilityName");
    //             String facilityQtty = resultSet.getString("facilityQtty");
    //             String facilityDescription = resultSet.getString("facilityDescription");
    //             String facilityType = resultSet.getString("facilityType");
    //             String facilityPic = resultSet.getString("facilityPic");

    //             facility facility;
    //             if (facilityType.equalsIgnoreCase("Room")) {
    //                 String roomCategory = resultSet.getString("roomCategory");
    //                 facility = new room(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, roomCategory);
    //             } else if (facilityType.equalsIgnoreCase("Equipment")) {
    //                 String equipType = equipmentResultSet.getString("equipType");
    //                 facility = new equipment(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic, equipType );
    //             } else {
    //                 // Handle the case when facilityType is neither "room" nor "equipment"
    //                 facility = new facility(facilityId, facilityStatus, facilityPrice, facilityName, facilityQtty, facilityDescription, facilityType, facilityPic);
    //             }

    //             model.addAttribute("facility", facility); // Use "facility" as the model attribute name

    //             connection.close();
    //         }
    //     } catch (SQLException e) {
    //         e.printStackTrace();
    //     }

    //     return "productadmin";
    // }

    // @PostMapping("/productadmin")
    // public String productadmin(@ModelAttribute("productadmin")  facility facility, room room, equipment equipment) {
    //     try {
    //         Connection connection = dataSource.getConnection();
    //         String sql = "UPDATE facility SET facilityId=?, facilityStatus=?, facilityPrice=?, facilityName=?, facilityQtty=?, facilityDescription=?, facilityType=?, facilityPic=? WHERE facilityId=?";
    //         final var statement = connection.prepareStatement(sql);

    //         statement.setString(1, facility.getFacilityId());
    //         statement.setString(2, facility.getFacilityStatus());
    //         statement.setString(3, facility.getFacilityPrice());
    //         statement.setString(4, facility.getFacilityName());
    //         statement.setString(5, facility.getFacilityQtty());
    //         statement.setString(6, facility.getFacilityDescription());
    //         statement.setString(7, facility.getFacilityType());
    //         statement.setString(8, facility.getFacilityPic());
    //         statement.executeUpdate();


    //         // Update fields specific to "room" or "equipment" based on the facility type
    //         if ("Room".equalsIgnoreCase(facility.getFacilityType())) {
    //             String roomSql = "UPDATE room SET roomCategory=? WHERE facilityId=?";
    //             final var roomStatement = connection.prepareStatement(roomSql);
    //             roomStatement.setString(1, room.getRoomCategory());
    //             roomStatement.setString(2, facility.getFacilityId());

    //             roomStatement.executeUpdate();
    //         } else if ("Equipment".equalsIgnoreCase(facility.getFacilityType())) {
    //             String equipmentSql = "UPDATE equipment SET equipType=? WHERE facilityId=?";
    //             final var equipmentStatement = connection.prepareStatement(equipmentSql);
    //             equipmentStatement.setString(2, equipment.getEquipType());
    //             equipmentStatement.setString(3, facility.getFacilityId());

    //             equipmentStatement.executeUpdate();
    //         }

    //         connection.close();

    //     } catch (SQLException e) {
    //         e.printStackTrace();
    //         return "redirect:/productadmin?success=false";
    //     }
    //     return "redirect:/product?success=true";
    // }

}
