
### Create Roles

 - Create roles can be done by root account only. _(Root account is the one you login using your email address.)_
 - Create roles action can be performed through CLI, API or UI.
 - Editing roles is simple and straightforward. All users under your root account will be able to view their roles that assigned to them.

### Attach Roles to User or Teams

 - Role can be created by root account only
 - Role can be assigned to _Users_ and _Teams_
 - _Users_ or _Teams_ can be attached with one Role only
 - Roles assigned on _Team_ will overwrite the roles assigned on _User_

### End User Effect

 - When users login to Mobingi ALM dashboard (or interacting through CLI or API), roles that attached to them will be evaluated on every action request.
 - If an action isn't granted by the role definition, such action will be denied.
 - If an action is grated by the role definition, the action will be allowed.


### On Dashboard

First time customers, use your root account login to ALM dashboard, then navigate to settings page at:

https://alm.mobingi.com/settings/user_roles


- ##### Step 1) Go to roles settings page, click on button "Create New Role":

    ![Image of RBAC Concept](https://learn-cdn.mobingi.com/images/getting-started-step-01.png)


- ##### Step 2) Create a new role with pre-defined role examples:

    ![Image of RBAC Concept](https://learn-cdn.mobingi.com/images/getting-started-step-02.png)
    
    Click on the button at bottom to create the new role. You can customize the role policy body. 
    For details on how to write your own policy document, please refer to [working with RBAC](https://learn.mobingi.com/enterprise/working-with-rbac) guide.


- ##### Step 3) Go to User Settings Page

    Navigate to: https://alm.mobingi.com/settings/user_roles

    ![Image of RBAC Concept](https://learn-cdn.mobingi.com/images/getting-started-step-03.png)
    
    Select the user you want to assign role to. Click on the button "Edit" to the right.

- ##### Step 4) Attach Role to User

    ![Image of RBAC Concept](https://learn-cdn.mobingi.com/images/getting-started-step-04.png)
    
    Finally, on the popup window, click on "Role" button and select the role you just create before and save to assign to the user.
    
    



