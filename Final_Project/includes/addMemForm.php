<?php
print '<form method="post" enctype="multipart/form-data">
            <table id="athleteform">
                <tbody>
                    <tr>
                        <td><label>First Name*:</label></td>
                        <td><input name="firstName" type="text" required></td>
                    </tr>
                    <tr>
                        <td><label>Last Name*:</label></td>
                        <td><input name="lastName" type="text" required></td>
                    </tr>
                    <tr>
                        <td><label>Sport*:</label></td>
                        <td>
                              <select name ="sport" required>
                                  <option></option>
                               <?php 
                                  $sports = ["Baseball", "MBasketball", "MXC", "Football", "Golf", "MHockey", "MLacrosse", "MPolo", "HWRowing", "LWRowing", "MSoccer", "SprintFootball", "MSquash", "MSwim&Dive", "MTennis", "MTrack&Field", "Wrestling", "WBasketball", "WXC", "Equestrian", "Fencing", "FieldHockey", "Gymnastics", "WHockey", "WLacrosse", "WPolo", "WRowing", "Sailing", "WSoccer", "Softball", "WSquash", "WSwim&Dive", "WTennis", "WTrack&Field", "Volleyball"];
                                  foreach ($sports as $sport) {
                                      print ("<option name=$sport>$sport</option>");
                                  }
                                  ?>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td><label>Graduation Year*:</label></td>
                        <td>                            
                            <select name ="Year" required>
                                <option></option>
                                <option name="2017">2017</option>
                                <option name="2018">2018</option>
                                <option name="2019">2019</option>
                                <option name="2020">2020</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Image:</label></td>
                        <td>
                            <input name="newphoto" type="file">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input value="Submit New Member" type="submit" name="addmember">
        </form>';
?>