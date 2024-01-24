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
import com.heroku.java.MODEL.reservation;


import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List; 

@Controller
public class ReservationController {
    private final DataSource dataSource;
    @Autowired
    public ReservationController(DataSource dataSource) {
        this.dataSource = dataSource;
    }
// add facility
    @GetMapping("/reservationCust")
    public String reservationCust() {
        return "reservationCust";
    }
// add facility
    @PostMapping("/reservationCust")
    public String reservationCust(Model model, @ModelAttribute("reservationCust") reservation reservation) {
        try {
            Connection connection = dataSource.getConnection();
            String sql = "INSERT INTO reservation(reserveId, reserveCheckIn, reserveCheckOut, reserveStatus, paymentStatus, receipt) VALUES (?,?,?,?,?,?)";
            final var statement = connection.prepareStatement(sql);

            String reserveId=reservation.getReserveId();
            String reserveCheckIn=reservation.getReserveCheckIn();
            String reserveCheckOut=reservation.getReserveCheckOut();
            String reserveStatus=reservation.getReserveStatus();
            String paymentStatus=reservation.getPaymentStatus();
            String receipt=reservation.getReceipt();
           
            statement.setString(1, reserveId);
            statement.setString(2, reserveCheckIn);
            statement.setString(3, reserveCheckOut);
            statement.setString(4, reserveStatus);
            statement.setString(5, paymentStatus);
            statement.setString(6, receipt);
            
            statement.executeUpdate();

            // Get id from database for sql 2 from sql 1
            String sql1 = "SELECT reserveId, reserveCheckIn, reserveCheckOut, reserveStatus, paymentStatus, receipt FROM public.reservation where reserveId=?";
            final var stmt = connection.prepareStatement(sql1);
            stmt.setString(1, reserveId);
            final var resultSet = stmt.executeQuery();

            model.addAttribute("success", true);

            connection.close();
        } catch (SQLException e) {
            e.printStackTrace();
            return "redirect:/reservationCust?success=false";
        }

        return "redirect:/cart?success=true";
    }
    // reservation list aka cart
    @GetMapping("/reservationlist")
    public String cart(Model model) {
        List<reservation> reservations = new ArrayList<>();

        try {
            Connection connection = dataSource.getConnection();
            String sql = "SELECT SELECT reserveId, reserveCheckIn, reserveCheckOut, reserveStatus, paymentStatus, receipt FROM reservation ORDER BY reserveId";
            final var statement = connection.createStatement();
            final var resultSet = statement.executeQuery(sql);

            while (resultSet.next()) {
                String reserveId = resultSet.getString("reserveId");
                String reserveCheckIn = resultSet.getString("reserveCheckIn");
                String reserveCheckOut = resultSet.getString("reserveCheckOut");
                String reserveStatus = resultSet.getString("reserveStatus");
                String paymentStatus = resultSet.getString("paymentStatus");
                String receipt = resultSet.getString("receipt");
                
                reservation reservation = new reservation();
                reservation.setReserveId(reserveId);
                reservation.setReserveCheckIn(reserveCheckIn);
                reservation.setReserveCheckOut(reserveCheckOut);
                reservation.setReserveStatus(reserveStatus);
                reservation.setPaymentStatus(paymentStatus);
                reservation.setReceipt(receipt);
                

                reservations.add(reservation);
            }

            model.addAttribute("reservations", reservations);

            connection.close();

        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "cart";
    }

    // view reservation
    @GetMapping("/facilityview")
    public String facilityview(@RequestParam("reserveId") String facilityId, Model model) {
        System.out.println("Reservation ID : " + reserveId);
        try {
            Connection connection = dataSource.getConnection();

            String sql = "SELECT reserveId, reserveCheckIn, reserveCheckOut, reserveStatus, paymentStatus, receipt FROM reservation WHERE reserveId = ?";

            final var statement = connection.prepareStatement(sql);
            statement.setString(1, reserveId);
            final var resultSet = statement.executeQuery();

            if (resultSet.next()) {
                
                String reserveId = resultSet.getString("reserveId");
                String reserveCheckIn = resultSet.getString("reserveCheckIn");
                String reserveCheckOut = resultSet.getString("reserveCheckOut");
                String reserveStatus = resultSet.getString("reserveStatus");
                String paymentStatus = resultSet.getString("paymentStatus");
                String receipt = resultSet.getString("receipt");

                model.addAttribute("reservation", reservation); // Use "reservation" as the model attribute name

                connection.close();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "facilityview";
    }

    // // get and post mapping for update reservation
     @GetMapping("/facilityedit")
    public String facilityedit(@RequestParam("reserveId") String reserveId, Model model) {
        try {
            System.out.println("reserveId from parameter: " + reserveId);
            Connection connection = dataSource.getConnection();
            String sql = "SELECT reserveId, reserveCheckIn, reserveCheckOut, reserveStatus, paymentStatus, receipt FROM reservation WHERE reserveId = ?";

            final var statement = connection.prepareStatement(sql);
            statement.setString(1, reserveId);
            final var resultSet = statement.executeQuery();

            if (resultSet.next()) {
               
                String reserveId = resultSet.getString("reserveId");
                String reserveCheckIn = resultSet.getString("reserveCheckIn");
                String reserveCheckOut = resultSet.getString("reserveCheckOut");
                String reserveStatus = resultSet.getString("reserveStatus");
                String paymentStatus = resultSet.getString("paymentStatus");
                String receipt = resultSet.getString("receipt");

                model.addAttribute("reservation", reservation); // Use "reservation" as the model attribute name

                connection.close();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return "facilityedit";
    }

    @PostMapping("/updateReservation")
    public String updateReservation(@ModelAttribute("updateReservation")  reservation reservation) {
        try {
            Connection connection = dataSource.getConnection();
            String sql = "UPDATE reservation SET reserveId=?, reserveCheckIn=?, reserveCheckOut=?, reserveStatus=?, paymentStatus=?, receipt=? FROM reservation WHERE reserveId = ?";
            final var statement = connection.prepareStatement(sql);

            String reserveId=reservation.getReserveId();
            String reserveCheckIn=reservation.getReserveCheckIn();
            String reserveCheckOut=reservation.getReserveCheckOut();
            String reserveStatus=reservation.getReserveStatus();
            String paymentStatus=reservation.getPaymentStatus();
            String receipt=reservation.getReceipt();
            

            
            statement.setString(1, reserveId);
            statement.setString(2, reserveCheckIn);
            statement.setString(3, reserveCheckOut);
            statement.setString(4, reserveStatus);
            statement.setString(5, paymentStatus);
            statement.setString(6, receipt);

            statement.executeUpdate();


                equipmentStatement.executeUpdate();
            }
             System.out.println("debug= " + reserveId);
            connection.close();

        } catch (Throwable t) {
            System.out.println("message : " + t.getMessage());
            System.out.println("error");
        }
        return  "redirect:/reservationList";
    }

    @GetMapping("/deleteReservation")
    public String deleteReservation(String reserveId) {
        
        
            try (Connection connection = dataSource.getConnection()){
                
                String sql = "DELETE FROM reservation WHERE reserveId = ?";
                PreparedStatement statement = connection.prepareStatement(sql);
                statement.setString(1, reserveId);
                // int rowsAffected = statement.executeUpdate();

                if (rowsAffected > 0) {
                    // Deletion successful
                    connection.close();
                    return "redirect:/reservationList"; 
                    // Redirect back to the facility list
                } else {
                    // Deletion failed
                    connection.close();
                    return "redirect:/reservationList";
                    // Redirect to an error page or show an error message
                }


            } catch (SQLException e) {
                e.printStackTrace();
                // Handle the exception as desired (e.g., show an error message)
                // Redirect to an error page or show an error message
                return "reservationList";
            }
        

        
    }



