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

import com.heroku.java.MODEL.staff;

import jakarta.servlet.http.HttpSession;

import java.sql.*;
import javax.sql.DataSource;
import java.util.ArrayList;
import java.util.Map;

import java.util.List;

@Controller
public class StaffController {
    private final DataSource dataSource;
    @Autowired
    public StaffController(DataSource dataSource) {
        this.dataSource = dataSource;
    }

//     // @GetMapping("/managerStaffList")
//     // public String managerStaffList(Model model) {
//     //     List<staff> staffs = new ArrayList<staff>();
//     // } hold dulu-
@GetMapping("/addstaff")
    public String addstaff() {
        return "addstaff";
    }
    // admin add staff
     @PostMapping("/addstaff")
    public String addstaff(@ModelAttribute("addstaff")staff staff){

        try {
            Connection connection = dataSource.getConnection();
            String sql = "INSERT INTO public.staff(staffId,staffName,staffEmail,staffPhoneNo,staffPass,adminId) VALUES(?,?,?,?,?,?)";
            final var statement = connection.prepareStatement(sql);

            String staffId = staff.getStaffId();
            String staffName = staff.getStaffName();
            String staffEmail = staff.getStaffEmail();
            String staffPhoneNo = staff.getStaffPhoneNo();
            String staffPass = staff.getStaffPass();
            String adminId = staff.getAdminId();
            
            statement.setString(1, staffId);
            statement.setString(2, staffName);
            statement.setString(3, staffEmail);
            statement.setString(4, staffPhoneNo);         
            statement.setString(5, staffPass);
            statement.setString(6, adminId);

            statement.executeUpdate();
            
             System.out.println("Staff ID Number : "+staffId);
            
            connection.close();
                
                } catch (Exception e) {
                    e.printStackTrace();
                    return "redirect:/index";
                }
            return "redirect:/admindashboard";
        }





// //     @GetMapping("/staffregister")
// //     public String staffregister() {
// //         // int staffsid = (int) session.getAttribute("staffId");
// //         // System.out.println("staff id :" + staffId);
// //         //return "admin/staffregister";
// //         return "staffregister";
// //     }

    @GetMapping("/stafflist")
    public String stafflist(Model model) {

        List<staff> staffs = new ArrayList<staff>();
        // Retrieve the logged-in staff's role from the session
        //int staffID = (int) session.getAttribute("staffID");
        //System.out.println("staffID stafflist : " + staffID);
        try (Connection connection = dataSource.getConnection()) {
            String sql = "SELECT staffId, staffName, staffEmail, staffPhoneNo, staffPass, adminId FROM staff order by staffID";
            final var statement = connection.prepareStatement(sql);
            //statement.setString(1, "baker");
            final var resultSet = statement.executeQuery();
            System.out.println("pass try stafflist >>>>>");

            while (resultSet.next()) {
                String staffId = resultSet.getString("staffId");
                String staffName = resultSet.getString("staffName");
                String staffEmail = resultSet.getString("staffEmail");
				String staffPhoneNo = resultSet.getString("staffPhoneNo");
                String staffPass = resultSet.getString("staffPass");
                String adminId = resultSet.getString("adminId");
                
                staff staff = new staff();
                staff.setStaffId(staffId);
                staff.setStaffName(staffName);
                staff.setStaffPhoneNo(staffPhoneNo);
                staff.setStaffPass(staffPass);
                staff.setAdminId(adminId);

                staffs.add(staff);
                model.addAttribute("staffs", staffs);
                //model.addAttribute("isManager", adminId == null); // Add Admin flag to the modelF

            }

            connection.close();

         //return "admin/stafflist";
          return "stafflist";
        } catch (SQLException e) {
            e.printStackTrace();
            // Handle the exception as desired (e.g., show an error message)
            return "error";
        }
        
    }

    @GetMapping("/deletestaff/")
    public String deleteStaff(String staffId) {
        // Retrieve the logged-in staff's role from the session
        //System.out.println("delete staff : " + staffId);
        //System.out.println(staffId);

            try (Connection connection = dataSource.getConnection()) {
                String sql = "DELETE FROM staff WHERE staffId = ?";
                PreparedStatement statement = connection.prepareStatement(sql);
                statement.setString(1, staffId);
                int rowsAffected = statement.executeUpdate();

                if (rowsAffected > 0) {
                    // Deletion successful
                    connection.close();
                    return "redirect:/stafflist";
                    // Redirect back to the staff list
                } else {
                    // Deletion failed
                    connection.close();
                    return "redirect:/stafflist";
                    // Redirect to an error page or show an error message
                }


            } catch (SQLException e) {
                e.printStackTrace();
                // Handle the exception as desired (e.g., show an error message)
                return "stafflist"; // Redirect to an error page or show an error message
            }
        // Redirect to an error page or back to the staff list
        //return "redirect:/stafflist";
    }

//    // @PostMapping("/staffregister")
//    //  public String staffregister( @ModelAttribute("staffregister") staff staff) {
//    //      /*String fullname = (String) session.getAttribute("staffName");
//    //      String userid = (String) session.getAttribute("staffId");*/

//    //      //debug
//    //      //System.out.println("fullname : "+staffName);
//    //      //System.out.println("userid : "+ staffId);
//    //      try {
//    //          Connection connection = dataSource.getConnection();
//    //          String sql1 = "INSERT INTO staff (staffId, staffName, staffEmail, staffPhoneNo, staffPass, adminId) VALUES (?,?,?,?,?,?)";
//    //          final var statement1 = connection.prepareStatement(sql1);

//    //          String staffId = staff.getStaffId();
//    //          String staffName = staff.getStaffName();
// 			// String staffEmail = staff.getStaffEmail();
//    //          String staffPhoneNo = staff.getStaffPhoneNo();
//    //          String staffPass = staff.getStaffPass();
//    //          String adminID = staff.getAdminID();

//    //          statement1.setString(1, staffId);
//    //          statement1.setString(2, staffName);
//    //          statement1.setString(3, staffEmail);
//    //          statement1.setString(3, staffPhoneNo);
//    //          statement1.setString(4,staffPass );
//    //          statement1.setString(5,adminId );
            
//    //          statement1.executeUpdate();

//    //          connection.close();
//    //          return "redirect:/stafflist";

//    //      } catch (SQLException sqe) {
//    //          System.out.println("Error Code = " + sqe.getErrorCode());
//    //          System.out.println("SQL state = " + sqe.getSQLState());
//    //          System.out.println("Message = " + sqe.getMessage());
//    //          System.out.println("printTrace /n");
//    //          sqe.printStackTrace();

//    //          return "redirect:/staffregister";
//    //      } catch (Exception e) {
//    //          System.out.println("E message : " + e.getMessage());
//    //          return "redirect:/staffregister";
//    //      }
//    //  }
    
    @GetMapping("/viewstaffprofile")
         public String viewstaffprofile(@RequestParam("staffId") String staffId, Model model) {
           System.out.println("Staff ID : " + staffId);
           try {
             Connection connection = dataSource.getConnection();
             String sql = "SELECT staffId, staffName, staffEmail, staffPhoneNo, staffPass, adminId FROM staff where staffId = ?";
             final var statement = connection.prepareStatement(sql);
             statement.setString(1, staffId);
             final var resultSet = statement.executeQuery();
         
             if (resultSet.next()) {
                String staffName = resultSet.getString("staffName");
                String staffEmail = resultSet.getString("staffEmail");
                String staffPhoneNo = resultSet.getString("staffPhoneNo");
                String staffPass = resultSet.getString("staffPass");
                String adminId = resultSet.getString("adminId");
                 
                staff staff = new staff();
                staff.setStaffId(staffId);
                staff.setStaffName(staffName);
                staff.setStaffEmail(staffEmail);
                staff.setStaffPhoneNo(staffPhoneNo);
                staff.setStaffPass(staffPass);
                staff.setAdminId(adminId);

                model.addAttribute("staff", staff); 
   
               connection.close();
             }
           } catch (Exception e) {
             e.printStackTrace();
           }
         
           return "viewstaffprofile";
         }

// //     @GetMapping("/managerDashboard")
// //     public String staffcount(Model model) {
// //         try {
// //             Connection connection = dataSource.getConnection();
// //             String sql = "SELECT COUNT(*) AS staffCount FROM staff";
// //             final var statement = connection.prepareStatement(sql);
// //             //statement.setString(1, staffId);
// //             final var resultSet = statement.executeQuery();

// //             if (resultSet.next()) {
// //                 int staffCount = resultSet.getInt("staffCount");

// //                 staff staff = new staff();
// //                 staff.setStaffCount(staffCount);
// //                 model.addAttribute("staff", staff);

// //                 connection.close();
// //             }
// //         } catch (Exception e) {
// //              e.printStackTrace();
// //            }
         
// //            return "adminDashboard";
// //          }

     @GetMapping("/updatestaff")
    public String updatestaff(@RequestParam("staffId") String staffId , Model model) {
       

    
            try {
                Connection connection = dataSource.getConnection();
                String sql = "SELECT staffName, staffEmail, staffPhoneNo, staffPass, adminId FROM staff WHERE staffId = ?";
                final var statement = connection.prepareStatement(sql);
                statement.setString(1, staffId);
                final var resultSet = statement.executeQuery();
                
                while (resultSet.next()) {
                    String staffName = resultSet.getString("staffName");
                    String staffEmail = resultSet.getString("staffEmail");
                    String staffPhoneNo = resultSet.getString("staffPhoneNo");
                    String staffPass = resultSet.getString("staffPass");
                    String adminId = resultSet.getString("adminId");
                    
                    // debug
                    //System.out.println("fullname from db = " + doctorName);

                    staff staff = new staff();
                    staff.setStaffId(staffId);
                    staff.setStaffName(staffName);
                    staff.setStaffEmail(staffEmail);
                    staff.setStaffPhoneNo(staffPhoneNo);
                    staff.setStaffPass(staffPass);
                    staff.setAdminId(adminId);

                    model.addAttribute("staff", staff);
                    

                }
                connection.close();
                
            } catch (SQLException e) {
                e.printStackTrace();
            }
        return "updatestaff";
}
    
    // Update Profile staff
    @PostMapping("/updatestaff")
    public String updatestaff(@ModelAttribute("staffedit") staff staff) {
        System.out.println("pass here <<<<<<<");
     try{
            Connection connection = dataSource.getConnection();
            String sql = "UPDATE staff SET staffName=?, staffEmail=?, staffPhoneNo=?, staffPass=?, adminId=?  WHERE staffID=?";
            final var statement = connection.prepareStatement(sql);
            String staffName = staff.getStaffName();
            String staffEmail = staff.getStaffEmail();
            String staffPhoneNo = staff.getStaffPhoneNo();
            String staffPass = staff.getStaffPass();
            String adminId = staff.getAdminId();
            String staffId = staff.getStaffId();

                statement.setString(1, staffName);
                statement.setString(2, staffEmail);
                statement.setString(3, staffPhoneNo);
                statement.setString(4, staffPass);
                statement.setString(5, adminId);
                statement.setString(6, staffId);
                statement.executeUpdate();
            System.out.println("debug= " + staffId + " " + staffName + " " + staffEmail + " " + staffPhoneNo + " " + staffPass + " " + adminId);

            connection.close();

        } catch (Throwable t) {
            System.out.println("message : " + t.getMessage());
            System.out.println("error");
        }
        return  "redirect:/stafflist";
    }

//     /*@GetMapping("/staffprofile")
//     public String viewprofilestaff(HttpSession session, Model model) {
//         String fullname = (String) session.getAttribute("staffName");
//         String userid = (String) session.getAttribute("staffId");
//         System.out.println("staff fullname : " + staffName);
//         System.out.println("staff id : " + staffId);

//         if (fullname != null) {
//             try {
//                 Connection connection = dataSource.getConnection();
//                 final var statement = connection.prepareStatement(
//                         "SELECT staffName, staffEmail, staffPhoneNo, staffPass, adminId FROM staffs WHERE staffsId = ?");
//                 statement.setInt(1, staffsId);
//                 final var resultSet = statement.executeQuery();

//                 while (resultSet.next()) {
//                     String fname = resultSet.getString("staffName");
//                     String email = resultSet.getString("staffEmail");
//                     String phone = resultSet.getString("staffPhoneNo");
//                     String password = resultSet.getString("staffPass");
//                     int admin = resultSet.getInt("adminId");
//                     // debug
//                     System.out.println("fullname from db = " + fname);

//                     staff staffprofile = new staff(userid, fname, email, phone, password, admin);

//                     model.addAttribute("staffprofile", staffprofile);
//                     System.out.println("fullname :" + staffprofile.getFullname());
//                     // Return the view name for displaying staff details --debug
//                     System.out.println("Session staffprofile : " + model.getAttribute("staffprofile"));

//                 }
//                 connection.close();
//                 return "staffprofile";
//             } catch (SQLException e) {
//                 e.printStackTrace();
//                 return "login";
//             }
//         } else {
//             return "login";
//         }
        

//     }*/

//     // // Update Profile staff
    // @PostMapping("/updatestaff")
    // public String updatestaff(@RequestParam("staffId") String staffId, Model model) {
    //     //String staffId = (int) session.getAttribute("staffId");

    //     String staffname = staff.getStaffName();
    //     String staffEmail = staff.getStaffEmail();
    //     String staffPhoneNo = staff.getStaffPhoneNo();
    //     String staffPass = staff.getStaffPass();
    //     String adminId = staff.getAdminId();

    //     // debug
    //     //System.out.println("id update = " + staffsId);
        
    //     try {
    //         Connection connection = dataSource.getConnection();
    //         String sql = "UPDATE staff SET staffName=?, staffEmail, staffPhoneNo=?, staffPass=?, adminId=? WHERE staffID=?";
    //         final var statement = connection.prepareStatement(sql);

    //             statement.setString(1, staffName);
    //             statement.setString(2, staffEmail);
    //             statement.setString(2, staffPhoneNo);
    //             statement.setString(3, staffPass);
    //             statement.setString(4, adminId);
    //             statement.setString(5, staffId);
    //             statement.executeUpdate();
    //         System.out.println("debug= " + staffId + " " + staffName + " " + adminId + " " + staffPhoneNo + " " + staffPass);

    //         connection.close();

    //         String returnPage = "updatestaff";
    //         return returnPage;

    //     } catch (Throwable t) {
    //         System.out.println("message : " + t.getMessage());
    //         System.out.println("error");
    //         return "redirect:/updatestaff";
    //     }
    // }

//     //delete controller
//     /*@GetMapping("/deletestaff")
//     public String deleteProfileCust(Model model) {
//         //String fullname = (String) session.getAttribute("staffName");
//         String staffId = (int) session.getAttribute("staffId");

//         if (staffName != null) {
//             try (Connection connection = dataSource.getConnection()) {

//                 // Delete user record
//                 final var deleteStaffStatement = connection.prepareStatement("DELETE FROM staffs WHERE staffId=?");
//                 deleteStaffStatement.setString(1, staffId);
//                 int userRowsAffected = deleteStaffStatement.executeUpdate();

//                 if (userRowsAffected > 0) {
//                     // Deletion successful
//                     // You can redirect to a success page or perform any other desired actions
                    
//                     session.invalidate();
//                     connection.close();
//                     return "redirect:/";
//                 } else {
//                     // Deletion failed
//                     connection.close();
//                      System.out.println("Delete Failed");
//                     return "deletestaff";
                   
//                 }
//             } catch (SQLException e) {
//                 // Handle any potential exceptions (e.g., log the error, display an error page)
//                 e.printStackTrace();

//                 // Deletion failed
//                 // You can redirect to an error page or perform any other desired actions
//                 System.out.println("Error");
//             }
//         }
//         // Username is null or deletion failed, handle accordingly (e.g., redirect to an
//         // error page)
//         return "stafforder";
//     }*/

   
// }


}


